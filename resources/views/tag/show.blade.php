@extends('layouts.app')
@section('content')

<h3 style="text-align:center" class="m-3">
   {{$tag->name}} Tag
</h3>


@foreach($posts as $post)
				<article class="row m-3">
					<div class="col-12">
						<div >
							<img loading="lazy" src="/images/{{$post->image_path}}" class="img-fluid mb-3">
						</div>
					</div>
					<div class="col-12 mx-auto">
						<h3><a class="post-title" href="{{route ('post.show', $post->slug )}}">{{$post->description}}</a></h3>
						<ul class="list-inline post-meta mb-4">
							<li class="list-inline-item"><i class="ti-user mr-2"></i>
								<a href="/">{{$post->user->name}}</a>
							</li>
							<li class="list-inline-item">Date : {{$post->created_at}}</li>
							<li class="list-inline-item">Categories : <a href="#!" class="ml-1">{{$post->category->name}} </a>
							</li>
						</ul>
						<p>{{$post->description}}.</p> <a href="{{route('post.show',$post->slug)}}" class="btn btn-outline-primary">Continue Reading</a>
					</div>
				</article>
			
@endforeach
@endsection