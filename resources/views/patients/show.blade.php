@extends('layouts.app')
@section('title', 'Patient Details | Clinic Patient Records')
@section('content')
<section class="heading">
    <div>
        <p class="eyebrow">PATIENT MANAGEMENT</p>
        <h1>Patient Details</h1>
        <p class="muted">Patient No. {{ $patient->patient_number }}</p>
    </div>
    <a class="button secondary" href="{{ route('patients.index') }}">Back to Patient List</a>
</section>
<section class="card">
    <div class="sectionhead"><h2>Personal Information</h2></div>
    <dl class="details">
        <div><dt>Patient Number</dt><dd>{{ $patient->patient_number }}</dd></div>
        <div><dt>Full Name</dt><dd>{{ $patient->last_name }}, {{ $patient->first_name }}</dd></div>
        <div><dt>Birth Date</dt><dd>{{ $patient->birth_date?->format('F d, Y') ?? '—' }}</dd></div>
        <div><dt>Sex</dt><dd>{{ $patient->sex }}</dd></div>
        <div><dt>Contact Number</dt><dd>{{ $patient->contact_number ?: 'Not provided' }}</dd></div>
        <div><dt>Address</dt><dd>{{ $patient->address ?: 'Not provided' }}</dd></div>
        <div><dt>Date Registered</dt><dd>{{ $patient->created_at?->format('F d, Y h:i A') ?? '—' }}</dd></div>
        <div><dt>Last Updated</dt><dd>{{ $patient->updated_at?->format('F d, Y h:i A') ?? '—' }}</dd></div>
    </dl>
    <div class="formactions">
        <a class="button" href="{{ route('patients.edit', $patient) }}">Edit Patient</a>
        <form class="inline-form" action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this patient record?');">
            @csrf
            @method('DELETE')
            <button class="button danger" type="submit">Delete Patient</button>
        </form>
        <a class="button secondary" href="{{ route('patients.index') }}">Back to List</a>
    </div>
</section>
@endsection
