@extends('layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                @foreach($posts as $post)
                    <article class="row mb-5">
                        <div class="mb-2">
                            <a href="{{ route('post.show', $post->slug) }}">
                                <img loading="lazy" src="/images/{{ $post->image_path }}" class="img-fluid" alt="post-thumb">
                            </a>
                        </div>
                        <div class="col-12 mx-auto">
                            <h3><a class="post-title" href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a></h3>
                            <ul class="list-inline post-meta mb-4">
                                <li class="list-inline-item"><i class="ti-user mr-2"></i><a href="{{ route('post.author', $post->user->id) }}">{{ $post->user->name }}</a></li>
                                <li class="list-inline-item">{{ $post->created_at }}</li>
                                <li class="list-inline-item">Categories: <a href="{{ route('category.show', $post->category->slug) }}" class="ml-1">{{ $post->category->name }}</a></li>
                                <li class="list-inline-item">Tags: 
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('tags.show', $tag->id) }}" class="ml-1">{{ $tag->name }}</a>{{ !$loop->last ? ',' : '' }}
                                    @endforeach
                                </li>
                            </ul>
                            <p>{{ $post->description }}</p>
                            <a href="{{ route('post.show', $post->slug) }}" class="btn btn-outline-primary">Continue Reading</a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>

            <aside class="col-lg-4 mt-5">
                <!-- Search -->
                <div class="widget">
                    <h5 class="widget-title"><span>Search</span></h5>
                    <form action="{{ route('post.search') }}" class="widget-search" method="GET">
                        <input id="search-query" name="search" type="search" placeholder="Type &amp; Hit Enter...">
                        <button type="submit"><i class="ti-search"></i></button>
                    </form>
                </div>
                <!-- Categories -->
                <div class="widget">
                    <h5 class="widget-title"><span>Categories</span></h5>
                    <ul class="list-unstyled widget-list">
                        @foreach($category as $category)
                            <li><a href="{{ route('category.show', $category->slug) }}" class="d-flex">{{ $category->name }}<small class="ml-auto">{{ $category->posts_count }}</small></a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Tags -->
                <div class="widget">
                    <h5 class="widget-title"><span>Tags</span></h5>
                    <ul class="list-inline widget-list-inline">
                        @foreach($tags as $tag)
                            <li class="list-inline-item"><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- Latest Posts -->
                <div class="widget">
                    <h5 class="widget-title"><span>Latest Articles</span></h5>
                    <ul class="list-unstyled widget-list">
                        @foreach($posts as $latestPost)
                            <li class="media widget-post align-items-center">
                                <a href="{{ route('post.show', $latestPost->slug) }}">
                                    <img loading="lazy" class="mr-3" src="/images/{{ $latestPost->image_path }}">
                                </a>
                                <div class="media-body">
                                    <h5 class="h6 mb-0"><a href="{{ route('post.show', $latestPost->slug) }}">{{ $latestPost->title }}</a></h5>
                                    <small>{{ $latestPost->created_at }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection