<x-app-layout>

    <x-slot name="header">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Article</h1>
            <a href="{{ route('articles.index') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
        </div>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <h4 class="m-0 font-weight-bold">{{ $article->title }}</h4>
                <hr>
                <div class="row">
                    <div class="col-md-8 offset-md-2 text-center">
                        <img src="{{ $article->image }}" class="img-fluid" style="width: 500px;" alt="article-img">
                    </div>
                </div>
                <hr>
                <p>{!! $article->content !!}</p>
                <span><strong>Link:</strong>&nbsp;<a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></span><br>
                <span class="badge {{ $article->status == 'Published' ? 'bg-success text-light' : 'bg-warning text-dark' }}">{{ $article->status}}</span><br>
                @php
                    $created_at = Carbon\Carbon::parse($article->created_at);
                    $relative_time = $created_at->diffForHumans();
                @endphp
                <span class="text-muted">{{ $relative_time }}</span>
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
