@extends('layouts.app')
@section('title', 'Patient Records | Clinic Patient Records')
@section('content')
<section class="heading">
    <div>
        <p class="eyebrow">PATIENT MANAGEMENT</p>
        <h1>Patient Records</h1>
        <p class="muted">Manage registered clinic patients.</p>
    </div>
    <a class="button" href="{{ route('patients.create') }}">+ Register New Patient</a>
</section>

<section class="stats">
    <div class="card">
        <span class="muted">Total Registered Patients</span>
        <strong class="total">{{ number_format($totalPatients) }}</strong>
    </div>
</section>

<section class="card">
    <div class="sectionhead">
        <div>
            <h2>All Patients</h2>
            <p class="muted">Search by patient number or name.</p>
        </div>
    </div>
    <form class="search-form" method="GET" action="{{ route('patients.index') }}">
        <input type="search" name="search" value="{{ $search }}" placeholder="Search patient number, first name, or last name..." aria-label="Search patients">
        <button class="button" type="submit">Search</button>
        @if ($search !== '')
            <a class="button secondary" href="{{ route('patients.index') }}">Clear</a>
        @endif
    </form>

    <div class="tablewrap">
        <table>
            <thead>
                <tr>
                    <th>Patient No.</th>
                    <th>Full Name</th>
                    <th>Birth Date</th>
                    <th>Sex</th>
                    <th>Contact Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr>
                        <td><b>{{ $patient->patient_number }}</b></td>
                        <td>{{ $patient->last_name }}, {{ $patient->first_name }}</td>
                        <td>{{ $patient->birth_date?->format('M d, Y') ?? '—' }}</td>
                        <td>{{ $patient->sex }}</td>
                        <td>{{ $patient->contact_number ?: '—' }}</td>
                        <td>
                            <div class="actions">
                                <a class="action-btn view-btn" href="{{ route('patients.show', $patient) }}">View</a>
                                <a class="action-btn edit-btn" href="{{ route('patients.edit', $patient) }}">Edit</a>
                                <form class="inline-form" action="{{ route('patients.destroy', $patient) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this patient record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn delete-btn" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty-state">
                        {{ $search !== '' ? 'No patient records match your search.' : 'No patient records yet. Select “Register New Patient” to add one.' }}
                    </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="tablefooter">
        <span>
            @if ($patients->total() > 0)
                Showing {{ $patients->firstItem() }}–{{ $patients->lastItem() }} of {{ $patients->total() }} matching records
            @else
                Showing 0 records
            @endif
        </span>
        <div class="pagination">{{ $patients->links() }}</div>
    </div>
</section>
@endsection
