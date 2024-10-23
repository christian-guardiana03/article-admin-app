<div class="row">
    <div class="col-md-6 mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="{{ isset($company) ? $company->name : '' }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option disabled selected>Select User Status</option>
            <option value="Active" {{ isset($company) && $company->status == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ isset($company) && $company->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @if ($errors->has('status'))
            <p class="text-danger">
                {{ $errors->first('status') }}
            </p>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="photo" class="form-label">Logo</label>
        <input type="file" class="form-control" name="photo" id="photo" aria-describedby="photo" onchange="previewImage(event)">
        @if ($errors->has('photo'))
            <p class="text-danger">
                {{ $errors->first('photo') }}
            </p>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        @php
            $image = isset($company) ? $company->logo_path : 'img/Placeholder_view_vector.svg.png';
        @endphp
        <img id="imagePreview" src="{{ asset($image) }}"  width="100" height="100" alt="Image Preview">
    </div>
</div>  