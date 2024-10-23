<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create User</h1>
            <a href="{{ route('user-management.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create User Form</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user-management.store') }}">
                @csrf
                @include('users_management._partials.forms')
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>


</x-app-layout>
