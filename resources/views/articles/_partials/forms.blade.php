<div class="row">
    <div class="col-md-8 mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control" name="image" id="image" aria-describedby="image" value="{{ isset($article) ? $article->image : '' }}" required onchange="previewImage(event)">
        <p class="text-danger hidden" id="invalid-url">Invalid Url</p>
        @if ($errors->has('image'))
            <p class="text-danger">
                {{ $errors->first('image') }}
            </p>
        @endif
    </div>
    <div class="col-md-4 mb-3">
        @php
            $image = isset($article) ? $article->image : 'img/Placeholder_view_vector.svg.png';
        @endphp
        <img id="imagePreview" src="{{ asset($image) }}"  width="100" height="100" alt="Image Preview">
    </div>
    <div class="col-md-6 mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ isset($article) ? $article->title : '' }}" required>
        @if ($errors->has('title'))
            <p class="text-danger">
                {{ $errors->first('title') }}
            </p>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="text" class="form-control" name="link" id="link" aria-describedby="link" value="{{ isset($article) ? $article->link : '' }}" required>
        @if ($errors->has('link'))
            <p class="text-danger">
                {{ $errors->first('link') }}
            </p>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" name="date" id="date" aria-describedby="date" value="{{ isset($article) ? date('Y-m-d', strtotime($article->date)) : date('Y-m-d') }}" required>
        @if ($errors->has('date'))
            <p class="text-danger">
                {{ $errors->first('date') }}
            </p>
        @endif
    </div>
    <div class="col-md-6 mb-3">
        <label for="date" class="form-label">Company</label>
        <select name="company_id" id="company_id" class="form-control">
            <option disabled selected>Select Company</option>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ isset($article) && $article->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('company_id'))
            <p class="text-danger">
                {{ $errors->first('company_id') }}
            </p>
        @endif
    </div>
    <div class="col-md-12 mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" rows="5" class="form-control">{{ isset($article->content) ? $article->content : '' }}</textarea>
    </div>
</div>  