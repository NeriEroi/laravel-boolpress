@extends('layouts.dashboard')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <ul>
        @foreach ($posts as $post)
            <li>
                <h5 class="text-secondary">{{ $post->title }}</h5>
            </li>
            <a class="btn btn-primary mb-5" href="{{ route('admin.posts.show', $post->slug) }}">Details</a>
            <a class="btn btn-warning mb-5" href="{{ route('admin.posts.edit', $post->id) }}">Modify</a>
            <form class="d-inline" method="POST" action="{{ route('admin.posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-5">Delete</button>
            </form>
        @endforeach
    </ul>

@endsection