<div class="row">
    <div class="col-md-6 mb-3">
        <label for="firstname" class="form-label">Firstname</label>
        <input type="text" class="form-control" name="firstname" id="firstname" aria-describedby="firstname" value="{{ isset($user) ? $user->firstname : '' }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="lastname" class="form-label">Lastname</label>
        <input type="text" class="form-control" name="lastname" id="lastname" aria-describedby="lastname" value="{{ isset($user) ? $user->lastname : '' }}" required>
    </div>
    <div class="col-md-12 mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="email" value="{{ isset($user) ? $user->email : '' }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="type" class="form-label">User Type</label>
        <select name="type" id="type" class="form-control" required>
            <option disabled selected>Select User Type</option>
            <option value="Editor" {{ isset($user_role) && $user_role == 'Editor' ? 'selected' : '' }}>Editor</option>
            <option value="Writer" {{ isset($user_role) && $user_role == 'Writer' ? 'selected' : '' }}>Writer</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control" required>
            <option disabled selected>Select User Status</option>
            <option value="Active" {{ isset($user) && $user->status == 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ isset($user) && $user->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
</div>  