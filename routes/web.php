<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;

Route::redirect('/', '/patients');

Route::resource('patients', PatientController::class);
