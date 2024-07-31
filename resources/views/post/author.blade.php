@extends('layouts.app')

@section('content')

<section class="section-sm border-bottom">
    <div class="container">
        <div class="row">
            <!-- User Profile Section -->
            <div class="col-12">
                <div class="title-bordered mb-5 d-flex align-items-center">
                    <h1 class="h4">{{ $user->name }}</h1>
                    <ul class="list-inline social-icons ml-auto d-none d-sm-block">
                        <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item"><a href="#"><i class="ti-github"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- User Image and Upload Form -->
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0 text-center text-md-left">
                <img loading="lazy" class="img-fluid rounded-lg w-50" src="/users/{{ $user->image }}" alt="{{ $user->name }}">
            </div>
            <div class="col-lg-9 col-md-8 content text-center text-md-left">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sit amet vulputate augue.</p>
                <p>Donec nisi dolor, consequat vel pretium id, auctor in dui. Nam iaculis, neque ac ullamcorper.</p>
                <!-- Image Upload Form -->
                <div class="card-body">
                    <form action="{{ route('uploadphoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image" class="form-control mb-2">
                        <input type="submit" value="Upload" class="btn btn-primary">
                        @error('image')
                            <div class="error mt-2">{{ $message }}</div>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title text-center mb-5">
                    <h2>Posted by this author</h2>
                </div>
            </div>
            @foreach($post as $posts)
                <div class="col-lg-4 col-sm-6 mb-4">
                    <article class="mb-5">
                        <div class="post-slider slider-sm">
                            @php
                                $isExternal = filter_var($posts->image_path, FILTER_VALIDATE_URL);
                            @endphp
                            <img loading="lazy" src="{{ $isExternal ? $posts->image_path : asset('images/' . $posts->image_path) }}" class="img-fluid" alt="{{ $posts->title }}">
                        </div>
                        <h3 class="h5"><a class="post-title" href="{{ route('post.show', $posts->slug) }}">{{ $posts->title }}</a></h3>
                        <ul class="list-inline post-meta mb-2">
                            <li class="list-inline-item">Date: {{ $posts->created_at->format('M d, Y') }}</li>
                            <li class="list-inline-item">Categories: <a href="#!" class="ml-1">{{ $posts->category->name }}</a></li>
                            <li class="list-inline-item">Tags: 
                                <a href="#!" class="ml-1">Photo</a>, 
                                <a href="#!" class="ml-1">Image</a>
                            </li>
                        </ul>
                        <p>{{ $posts->description }}</p>
                        <a href="{{ route('post.show', $posts->slug) }}" class="btn btn-outline-primary">Continue Reading</a>
                    </article>
                </div>
            @endforeach
        </div>
        <!-- Pagination Links -->
     <div class="d-flex justify-content-center">
            {{ $post->links() }}
        </div>
    </div>
</section>

<footer class="section-sm pb-0 border-top border-default">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-3 mb-4">
                <a class="mb-4 d-block" href="index.html">
                    <img class="img-fluid" width="150px" src="images/logo.png" alt="LogBook">
                </a>
                <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <h6 class="mb-4">Quick Links</h6>
                <ul class="list-unstyled footer-list">
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                    <li><a href="terms-conditions.html">Terms Conditions</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 col-6 mb-4">
                <h6 class="mb-4">Social Links</h6>
                <ul class="list-unstyled footer-list">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">LinkedIn</a></li>
                    <li><a href="#">GitHub</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h6 class="mb-4">Subscribe Newsletter</h6>
                <form class="subscription" action="javascript:void(0)" method="post">
                    <div class="position-relative">
                        <i class="ti-email email-icon"></i>
                        <input type="email" class="form-control" placeholder="Your Email Address">
                    </div>
                    <button class="btn btn-primary btn-block rounded" type="submit">Subscribe now</button>
                </form>
            </div>
        </div>
        <div class="scroll-top">
            <a href="javascript:void(0);" id="scrollTop"><i class="ti-angle-up"></i></a>
        </div>
        <div class="text-center">
            <p class="content">&copy; {{ date('Y') }} - Design &amp; Develop By <a href="https://themefisher.com/" target="_blank">Themefisher</a></p>
        </div>
    </div>
</footer>

<!-- JS Plugins -->
<script src="plugins/jQuery/jquery.min.js"></script>
<script src="plugins/bootstrap/bootstrap.min.js" async></script>
<script src="plugins/slick/slick.min.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

@endsection