<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Company</h1>
            <a href="{{ route('companies.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Company Form</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                @csrf
                @include('companies._partials.forms')
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

    <x-slot name="custom_scripts">
        <script>
            function previewImage(event) {
                const reader = new FileReader();

                reader.onload = function() {
                    document.getElementById('imagePreview').src = reader.result;
                };

                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </x-slot>

</x-app-layout>
