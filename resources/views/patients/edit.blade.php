@extends('layouts.app')
@section('title', 'Edit Patient | Clinic Patient Records')
@section('content')
<section class="heading">
    <div>
        <p class="eyebrow">PATIENT MANAGEMENT</p>
        <h1>Edit Patient</h1>
        <p class="muted">Update the information for {{ $patient->first_name }} {{ $patient->last_name }}.</p>
    </div>
</section>
<section class="card">
    <form action="{{ route('patients.update', $patient) }}" method="POST">
        @csrf
        @method('PUT')
        @include('patients._form', ['patient' => $patient])
        <div class="formactions">
            <button class="button" type="submit">Save Changes</button>
            <a class="button secondary" href="{{ route('patients.show', $patient) }}">Cancel</a>
        </div>
    </form>
</section>
@endsection
