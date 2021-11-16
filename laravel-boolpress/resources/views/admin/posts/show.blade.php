@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    ID del post: {{ $post->id }}
                </h1>
                <h2>
                    {{ $post->title }}
                </h2>
                <p>
                    {{ $post->content }}
                </p>
                @if ($post->cover)
                    <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}"><br>
                @endif
                <small>
                    Slug: {{ $post->slug }}
                </small>
            </div>
        </div>
    </div>

@endsection