@extends('layout.default')

@section('content')
    <div class="container my-5">
        <div class="bg-light p-5 rounded">
            <div class="col-sm-8 py-5 mx-auto">
                <h1 class="display-5 fw-normal">{{ $post->title }}</h1>
                <p class="fs-5">{{ $post->body }}</p>
            </div>
        </div>
    </div>


    @include('components.error-handler')
    @include('components.session-handler')
@endsection
