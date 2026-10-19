@extends('layouts.app')
@section('title', 'Register Patient | Clinic Patient Records')
@section('content')
<section class="heading">
    <div>
        <p class="eyebrow">PATIENT MANAGEMENT</p>
        <h1>Register New Patient</h1>
        <p class="muted">Enter the patient's information below. Fields marked * are required.</p>
    </div>
</section>
<section class="card">
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        @include('patients._form', ['patient' => null])
        <div class="formactions">
            <button class="button" type="submit">Save Patient</button>
            <a class="button secondary" href="{{ route('patients.index') }}">Cancel</a>
        </div>
    </form>
</section>
@endsection
