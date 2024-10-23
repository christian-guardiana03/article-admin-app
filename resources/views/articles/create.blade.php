<x-app-layout>

    <x-slot name="custom_css">
        <style>
            .hidden {
                display: none;
            }
            .content-container {
                width: 795px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </x-slot>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Article</h1>
            <a href="{{ route('articles.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Article Form</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('articles.store') }}">
                @csrf
                @include('articles._partials.forms')
                <button type="submit" class="btn btn-primary" id="create-article">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="custom_scripts">
        <script src="https://cdn.tiny.cloud/1/5j44jut5yda3g54z8xnsxtjqhaqi8q08qzyrmgncfvpqn1vh/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea#content', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });
        </script>
        <script>

            function previewImage(event) {
                const url = event.target.value;
                const image = document.getElementById('imagePreview');
                const validation = document.getElementById('invalid-url');
                const button = document.getElementById('create-article');
                if (isValidUrl(url)) {
                    image.src = url;
                    validation.style.display = 'none';
                    button.disabled = false;
                } else {
                    validation.style.display = 'block';
                    // button.disabled = true;
                }
            }

            function isValidUrl(url) {
                try {
                    new URL(url);
                    return true;
                } catch (error) {
                    return false;
                }
            }
        </script>
    </x-slot>


</x-app-layout>
