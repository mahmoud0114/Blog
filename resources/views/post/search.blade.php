@extends('layouts.app')
@section('content')

@if (count($results) > 0)
    <ul>
        @foreach ($results as $result)
         
   <article class="row mb-4">
			<div class="col-lg-10 mx-auto mb-4">
				<h1 class="h2 mb-3">{{$result->title}}</h1>
				<ul class="list-inline post-meta mb-3">
					<li class="list-inline-item"><i class="ti-user mr-2"></i><a href="author.html">{{$result->user->name}}</a>
					</li>
					<li class="list-inline-item">{{$result->created_at}}</li>
					<li class="list-inline-item">Categories : <a href="#!" class="ml-1">{{$result->category->name}} </a>
					</li>
				</ul>
			</div>
			<div class="col-12 mb-3">
				<div class="post-slider">
					<img src="/images/{{$result->image_path}}" class="img-fluid" alt="post-thumb">
				</div>
			</div>
			<div class="col-lg-10 mx-auto">
				<div class="content">
					<p>{{$result->description}}</p>
				</div>
			</div>
		</article>
         
        @endforeach
    </ul>
@else
    <p>No results found.</p>
@endif

@endsection