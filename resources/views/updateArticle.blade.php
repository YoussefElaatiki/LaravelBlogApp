@extends('layouts.app')

@section('content')
    <div class="container mt-2 ">
        <h1 class=" mt-4 text-center">Update Article {{ $article->id }}</h1>
        <div class="col-8 ">
            <form action="{{ route('articles.update', ['article' => $article->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}">
                     @error('title')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">content</label>
                    <textarea class="form-control" id="content" name="content" rows="8"> {{ $article->content }}</textarea>
                    @error('content')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror
                    <label class="mt-3" for="image" class="form-label">Image:</label>
                    <div>
                        <img src="{{ asset($article->image) }}" class="m-2" alt="article image" width="100px">
                    </div>
                    <input type="file" class="form-control" id="image" name="image">

                    <div class="d-flex justify-content-around">
                        @foreach ($categories as $category)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="categories[]"
                                    value="{{ $category->id }}" id="category.{{ $category->id }}"
                                    {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}>
                                <label class="form-check-label" for="category.{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-warning mt-2 text-center">Update</button>
            </form>
        </div>
    </div>
@endsection
