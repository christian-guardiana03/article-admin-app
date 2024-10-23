<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Companies</h1>
            <a href="{{ route('companies.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Create Company</a>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Companies List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Logo</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($companies as $company)
                            <tr>
                                <td class="text-center">
                                    <img id="imagePreview" src="{{ asset($company->logo_path) }}" width="50" height="50" alt="Image Preview">
                                </td>
                                <td>{{ $company->name  }}</td>
                                <td>{{ $company->status  }}</td>
                                <td>
                                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Available Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <x-slot name="custom_scripts">
        <script>
            @if (session()->has('success'))
                Swal.fire({
                    title: 'Success',
                    text: '{{ session("success") }}',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                })
            @endif
        </script>
    </x-slot>

</x-app-layout>
