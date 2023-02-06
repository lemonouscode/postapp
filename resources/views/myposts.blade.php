@extends('layout.default')


@section('content')
    <div class="row mb-2">

        @foreach ($myposts as $post)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <form action=" {{ url('/deletepost/' . $post->id) }}" method="POST">
                        @csrf
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-success">Post</strong>
                            <h3 class="mb-0">{{ $post->title }}</h3>
                            <div class="mb-1 text-muted">{{ $post->created_at->diffForHumans() }}</div>
                            <p class="mb-auto">{{ $post->body }}</p>
                            <a href="/posts/{{ $post->id }}">Continue reading</a>
                            <input type="submit" value="Delete">

                            <input type="hidden" name="id" value=" {{ $post->id }} ">
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

    </div>


    @include('components.error-handler')
    @include('components.session-handler')
@endsection
