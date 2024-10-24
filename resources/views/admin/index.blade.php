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
                <li class="nav-item"><a class="nav-link custom-navs active" id="Nav1" data-bs-toggle="tab" href="#Tab1">{{ Auth::user()->getRoleNames()[0] == 'Writer' ? 'For Edit' : 'For Publish' }}&nbsp;<span class="badge badge-info">{{ $published->count() }}</span></a></li>
                <li class="nav-item"><a class="nav-link custom-navs" data-bs-toggle="tab" href="#Tab2">Published&nbsp;<span class="badge badge-info">{{ $published->count() }}</span></a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane active" id="Tab1">
                    @forelse ($unpublished as $unpublish)
                        @php
                            $created_at = Carbon\Carbon::parse($unpublish->created_at)->format('M d, Y H:i a');
                        @endphp
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $unpublish->image }}" style="width: 100%;height: 100%;"  class="img-fluid rounded-start" alt="article-image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $unpublish->title }}</h5>
                                        <p class="card-text"><span class="badge {{ $unpublish->status == 'Published' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $unpublish->status  }}</span></p>
                                        <p class="card-text">
                                            <small class="text-muted">Link:&nbsp;<a href="{{ $unpublish->link }}" target="_blank">{{ $unpublish->link }}</a></small><br>
                                            <small class="text-muted">Writer:&nbsp;{{ $unpublish->writer ? $unpublish->writer->getFullName() : '' }}</small><br>
                                            <small class="text-muted">Editor:&nbsp;{{ $unpublish->editor ? $unpublish->editor->getFullName() : '' }}</small><br>
                                            <small class="text-muted">Created on:&nbsp;{{ $created_at }}</small>
                                        </p>
                                        <p class="card-text">
                                            <small>
                                                <a href="{{ route('articles.show', $unpublish->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @if ($unpublish->status == 'For Edit' && (Auth::user()->can('edit article') || Auth::user()->can('edit unpublish article')))
                                                    <a href="{{ route('articles.edit', $unpublish->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Available Data.</p>
                    @endforelse
                </div>
                <div class="tab-pane" id="Tab2">
                    @forelse ($published as $publish)
                        @php
                            $created_at = Carbon\Carbon::parse($publish->created_at)->format('M d, Y H:i a');
                        @endphp
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ $publish->image }}" style="width: 100%;height: 100%;" class="img-fluid rounded-start" alt="article-image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $publish->title }}</h5>
                                        <p class="card-text"><span class="badge {{ $publish->status == 'Published' ? 'bg-success text-light' : 'bg-warning text-dark' }}">{{ $publish->status  }}</span></p>
                                        <p class="card-text">
                                            <small class="text-muted">Writer:&nbsp;{{ $publish->writer ? $publish->writer->getFullName() : '' }}</small><br>
                                            <small class="text-muted">Editor:&nbsp;{{ $publish->editor ? $publish->editor->getFullName() : '' }}</small><br>
                                            <small class="text-muted">Created on:&nbsp;{{ $created_at }}</small>
                                        </p>
                                        <p class="card-text">
                                            <small>
                                                <a href="{{ route('articles.show', $publish->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                                                @if ($publish->status == 'For Edit' && (Auth::user()->can('edit article') || Auth::user()->can('edit unpublish article')))
                                                    <a href="{{ route('articles.edit', $publish->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                @endif
                                            </small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No Available Data.</p>
                    @endforelse
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