@extends('layouts.dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>
                    NUOVO POST
                </h1>

                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Contenuto</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- immagine --}}
                    <div class="form-group">
                        <label class="d-block" for="image">Immagine</label>
                        <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- immagine --}}

                    <div class="form-group">
                        <label for="category_id">Categorie: </label>
                        <select name="category_id" id="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- stampa dei tags  --}}
                    <div class="form-group">
                        <p>Tags: </p>
                        <div class="form-check">
                            @foreach ($tags as $tag)
                                <div class="form-check form-check-inline">
                                    <input value="{{ $tag->id }}" id="{{ 'tag' . $tag->id }}" type="checkbox" name="tags[]" class="form-check-input">
                                    <label for="{{ 'tag' . $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

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