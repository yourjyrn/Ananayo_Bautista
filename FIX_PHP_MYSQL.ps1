$ErrorActionPreference = 'Stop'
$php = 'C:\php83\php.exe'
$ini = 'C:\php83\php.ini'
$ext = 'C:\php83\ext\php_pdo_mysql.dll'
if (!(Test-Path $php)) { Write-Host 'ERROR: C:\php83\php.exe was not found.'; exit 1 }
if (!(Test-Path $ext)) { Write-Host 'ERROR: php_pdo_mysql.dll is missing from C:\php83\ext.'; Write-Host 'Re-extract the official PHP 8.3.35 x64 ZIP into C:\php83.'; exit 1 }
if (!(Test-Path $ini)) {
  $dev = 'C:\php83\php.ini-development'
  if (!(Test-Path $dev)) { Write-Host 'ERROR: php.ini-development was not found in C:\php83.'; exit 1 }
  Copy-Item $dev $ini
}
$content = Get-Content $ini -Raw
if ($content -match '(?m)^\s*;?\s*extension_dir\s*=') {
  $content = [regex]::Replace($content, '(?m)^\s*;?\s*extension_dir\s*=.*$', 'extension_dir = "C:\php83\ext"')
} else {
  $content = "extension_dir = `"C:\php83\ext`"`r`n" + $content
}
if ($content -match '(?m)^\s*;?\s*extension\s*=\s*pdo_mysql\s*$') {
  $content = [regex]::Replace($content, '(?m)^\s*;?\s*extension\s*=\s*pdo_mysql\s*$', 'extension=pdo_mysql')
} elseif ($content -notmatch '(?m)^\s*extension\s*=\s*php_pdo_mysql\.dll\s*$') {
  $content += "`r`nextension=pdo_mysql`r`n"
}
Set-Content -Path $ini -Value $content -Encoding ASCII
Write-Host 'Checking PHP MySQL driver...'
$modules = & $php -m 2>&1
if ($LASTEXITCODE -ne 0 -or ($modules -notcontains 'pdo_mysql')) {
  Write-Host 'ERROR: pdo_mysql did not load. PHP diagnostic:'
  & $php --ri pdo_mysql
  exit 1
}
Write-Host 'SUCCESS: pdo_mysql is enabled.'
Write-Host 'PHP version:'
& $php -v | Select-Object -First 1
exit 0
