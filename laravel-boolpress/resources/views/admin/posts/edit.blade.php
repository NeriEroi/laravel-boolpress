@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    MODIFICA POST
                </h1>
                <form action="{{ route('admin.posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Contenuto</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{!! old('content', $post->content) !!}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- immagine --}}
                    <div class="form-group">
                        @if ($post->cover)
                            <p>
                                Immagine attuale:
                            </p>
                            <img class="d-block" src="{{ asset( 'storage/' . $post->cover ) }}" alt="">
                        @else
                            <p>
                                Immagine assente
                            </p>
                        @endif
                        <label class="d-block" for="image">Immagine</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- immagine --}}

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            CREA POST
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection