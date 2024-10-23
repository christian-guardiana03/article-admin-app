<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link custom-navs active" id="Nav1" data-bs-toggle="tab" href="#Tab1">{{ Auth::user()->getRoleNames()[0] == 'Writer' ? 'For Edit' : 'For Publish' }}</a></li>
                <li class="nav-item"><a class="nav-link custom-navs" data-bs-toggle="tab" href="#Tab2">Published</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="Tab1">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Writer</th>
                                    <th>Editor</th>
                                    <th>Status</th>
                                    <th style="width: 120px !important;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($unpublished as $unpublish)
                                    <tr>
                                        <td class="text-center">
                                            <img id="imagePreview" src="{{ asset($unpublish->image) }}" width="50" height="50" alt="Image Preview">
                                        </td>
                                        <td>{{ $unpublish->title }}</td>
                                        <td><a href="{{ $unpublish->link }}" target="_blank">{{ $unpublish->link }}</a></td>
                                        <td>{{ $unpublish->writer ? $unpublish->writer->getFullName() : '' }}</td>
                                        <td>{{ $unpublish->editor ? $unpublish->editor->getFullName() : '' }}</td>
                                        <td><span class="badge {{ $unpublish->status == 'Published' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $unpublish->status  }}</span></td>
                                        <td>
                                            <a href="{{ route('articles.show', $unpublish->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @if (Auth::user()->can('edit article') || ($unpublish->status == 'For Edit' && Auth::user()->can('edit unpublish article')))
                                                <a href="{{ route('articles.edit', $unpublish->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Available Article/s</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $unpublished->links() }}
                    </div>
                </div>
                <div class="tab-pane" id="Tab2">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th style="width: 15%;">Link</th>
                                    <th>Writer</th>
                                    <th>Editor</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($published as $publish)
                                    <tr>
                                        <td class="text-center">
                                            <img id="imagePreview" src="{{ asset($publish->image) }}" width="50" height="50" alt="Image Preview">
                                        </td>
                                        <td>{{ $publish->title }}</td>
                                        <td><a href="{{ $publish->link }}" target="_blank">{{ $publish->link }}</a></td>
                                        <td>{{ $publish->writer ? $publish->writer->getFullName() : '' }}</td>
                                        <td>{{ $publish->editor ? $publish->editor->getFullName() : '' }}</td>
                                        <td><span class="badge {{ $publish->status == 'Published' ? 'bg-success text-light' : 'bg-warning text-dark' }}">{{ $publish->status  }}</span></td>
                                        <td>
                                            <a href="{{ route('articles.show', $publish->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                            @if (Auth::user()->can('edit article') || ($publish->status == 'For Edit' && Auth::user()->can('edit unpublish article')))
                                                <a href="{{ route('articles.edit', $publish->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Available Article/s</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $unpublished->links() }}
                    </div>
                </div>
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
            $(document).ready(function() {
                $('.custom-navs').click(function(event) {
                    event.preventDefault();

                    // Get the target tab pane ID
                    var target = $(this).attr('href');

                    // Remove active classes from both tab panes and navigation links
                    $('.tab-pane, .custom-navs').removeClass('active');

                    // Add the active class to the target tab pane and navigation link
                    $(target).addClass('active');
                    $(this).addClass('active');
                });
            });

        </script>
    </x-slot>

</x-app-layout>