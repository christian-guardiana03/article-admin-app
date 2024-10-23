<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Articles</h1>
            @if (Auth::user()->can('create article'));
                <a href="{{ route('articles.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Create Article</a>
            @endif
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Articles List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th style="width: 25%;">Link</th>
                            <th>Writer</th>
                            <th>Editor</th>
                            <th>Status</th>
                            <th style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($articles as $article)
                            <tr>
                                <td class="text-center">
                                    <img id="imagePreview" src="{{ asset($article->image) }}" width="50" height="50" alt="Image Preview">
                                </td>
                                <td>{{ $article->title }}</td>
                                <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
                                <td>{{ $article->writer ? $article->writer->getFullName() : '' }}</td>
                                <td>{{ $article->editor ? $article->editor->getFullName() : '' }}</td>
                                <td><span class="badge {{ $article->status == 'Published' ? 'bg-success text-light' : 'bg-warning text-dark' }}">{{ $article->status  }}</span></td>
                                <td>
                                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                    @if ($article->status == 'For Edit' && (Auth::user()->can('edit article') || Auth::user()->can('edit unpublish article')))
                                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
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
