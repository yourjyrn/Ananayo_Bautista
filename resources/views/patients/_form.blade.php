<div class="form-grid">
    <div class="form-group">
        <label for="patient_number">Patient Number <span aria-hidden="true">*</span></label>
        <input class="form-control" id="patient_number" name="patient_number" value="{{ old('patient_number', $patient?->patient_number) }}" maxlength="50" required>
        @error('patient_number') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="sex">Sex <span aria-hidden="true">*</span></label>
        <select class="form-control" id="sex" name="sex" required>
            <option value="">Select sex</option>
            <option value="Male" @selected(old('sex', $patient?->sex) === 'Male')>Male</option>
            <option value="Female" @selected(old('sex', $patient?->sex) === 'Female')>Female</option>
        </select>
        @error('sex') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="first_name">First Name <span aria-hidden="true">*</span></label>
        <input class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $patient?->first_name) }}" maxlength="100" autocomplete="given-name" required>
        @error('first_name') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="last_name">Last Name <span aria-hidden="true">*</span></label>
        <input class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $patient?->last_name) }}" maxlength="100" autocomplete="family-name" required>
        @error('last_name') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="birth_date">Birth Date <span aria-hidden="true">*</span></label>
        <input class="form-control" type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $patient?->birth_date?->format('Y-m-d')) }}" max="{{ now()->toDateString() }}" required>
        @error('birth_date') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <label for="contact_number">Contact Number</label>
        <input class="form-control" type="tel" id="contact_number" name="contact_number" value="{{ old('contact_number', $patient?->contact_number) }}" maxlength="30" autocomplete="tel">
        @error('contact_number') <span class="field-error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group full">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3" maxlength="2000" autocomplete="street-address">{{ old('address', $patient?->address) }}</textarea>
        @error('address') <span class="field-error">{{ $message }}</span> @enderror
    </div>
</div>
