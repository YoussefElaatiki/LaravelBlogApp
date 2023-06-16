@extends('layouts.app')

@section('content')
    <div class="container mt-2 ">
        <h1 class=" mt-4 text-center">Add Article</h1>
        <div class="col-8 ">
            <form action="{{route('articles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" class="form-control" id="title" name="title">
                    @error('title')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror
                </div>

                <label for="content" class="form-label">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="8"> </textarea>
                @error('content')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror

                <label class="mt-3" for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror

                <div class="d-flex justify-content-around mt-3">
                    @foreach ($categories as $category)
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}"
                                id="category.{{ $category->id }}">
                            <label class="form-check-label" for="category.{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('categories[]')
                    <p class='text-danger'>{{$message}}</p>
                    @enderror
                </div>


                <button type="submit" class="btn btn-success mt-3 text-center">Submit</button>
            </form>
        </div>
    </div>
@endsection
