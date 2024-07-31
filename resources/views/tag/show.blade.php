@extends('layouts.app')
@section('content')

<h3 style="text-align:center" class="m-3">
   {{$tag->name}} Tag
</h3>


@foreach($posts as $post)
				<article class="row m-3">
					<div class="col-12">
						<div >
              @php
              $isExternal = filter_var($post->image_path, FILTER_VALIDATE_URL);
              @endphp

              <img loading="lazy"
              src="{{ $isExternal ? $post->image_path : asset('images/' . $post->image_path) }}"
              class="img-fluid"
              alt="{{ $post->title }}">
						</div>
					</div>
					<div class="col-12 mx-auto">
						<h3><a class="post-title" href="{{route ('post.show', $post->slug )}}">{{$post->title}}</a></h3>
						<ul class="list-inline post-meta mb-4">
							<li class="list-inline-item"><i class="ti-user mr-2"></i>
								<a href="/">{{$post->user->name}}</a>
							</li>
							<li class="list-inline-item">Date : {{$post->created_at}}</li>
							<li class="list-inline-item">Categories : <a href="#!" class="ml-1">{{$post->category->name}} </a>
							</li>
						</ul>
						<p>{{Str::limit($post->description,150)}}.</p> <a href="{{route('post.show',$post->slug)}}" class="btn btn-outline-primary">Continue Reading</a>
					</div>
				</article>
<hr class="border border-primary my-4">
@endforeach
@endsection