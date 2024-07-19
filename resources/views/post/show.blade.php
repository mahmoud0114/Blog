@extends('layouts.app')
@section('content')

<section class="section">
    <div class="container">
        <article class="row mb-4">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-lg-10 mx-auto mb-4">
                <h1 class="h2 mb-3">{{ $post->title }}</h1>
                <ul class="list-inline post-meta mb-3">
                    <li class="list-inline-item"><i class="ti-user mr-2"></i><a href="{{ route('post.author', $post->user->id) }}">{{ $post->user->name }}</a></li>
                    <li class="list-inline-item">{{ $post->created_at }}</li>
                    <li class="list-inline-item">Categories : <a href="#!" class="ml-1">{{ $post->category->name }}</a></li>
                    <li class="list-inline-item">Tags : 
                        @foreach($tags as $tag)
                            <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-12 mb-3">
                <div class="post-slider">
                    <img src="/images/{{ $post->image_path }}" class="img-fluid" alt="post-thumb">
                </div>
            </div>
            <div class="col-lg-10 mx-auto">
                <div class="content">
                    <p>{{ $post->description }}</p>
                </div>
            </div>
        </article>

        @can('update-post', $post)
            <div class="container">
                <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-outline-primary">Edit</a>
            </div>
            <form method="POST" action="{{ route('post.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger m-3">Delete</button>
            </form>
        @endcan
    </div>

    @if(Auth::check())
        <form method="POST" action="{{ route('comment.store') }}" class="ml-2">
            @csrf
            <div class="form-group">
                <input type="text" name="comment" class="form-control" placeholder="Write a comment">
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="hidden" name="slug" value="{{ $post->slug }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endif

    <div class="container ml-2 mt-4">
        @foreach($comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->comment }}</p>
                    <small>by: {{ $comment->user->name }}</small>
                    @if(Auth::check() && Auth::user()->id == $comment->user->id)
                        <form method="POST" action="{{ route('comment.destroy', $comment->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>

<div class="widget">
    <h5 class="widget-title ml-2"><span>Latest Article</span></h5>
    @foreach($posts as $post)
        <ul class="list-unstyled widget-list ml-2">
            <li class="media widget-post align-items-center">
                <a href="{{ route('post.show', $post->slug) }}">
                    <img loading="lazy" class="mr-3" src="/images/{{ $post->image_path }}">
                </a>
                <div class="media-body">
                    <h5 class="h6 mb-0"><a href="post-elements.html">{{ $post->description }}</a></h5>
                    <small>{{ $post->created_at }}</small>
                </div>
            </li>
        </ul>
    @endforeach
</div>

@endsection