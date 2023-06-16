@extends('layouts.app')

@section('content')


    <div class="text-center">
        <a href="{{ route('articles.create') }}">
            <button class="btn btn-success mt-5">Add Article</button>
        </a>
    </div>

    <div class="container   justify-content-between   text-center mt-5">
        <div class="row ">
            <form action="{{ route('articles.search') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search articles...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            @forelse($articles as $article)
                <div class="card col-5 mx-auto my-2">
                    <div class="card-header">
                        <p>published at: {{ $article->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ $article->content }}</p>

                        <div class="d-inline">
                            @foreach ($article->categories as $category)
                                <span class="badge bg-dark">{{ $category->name }}</span>
                            @endforeach
                        </div>

                        @if ($article->image)
                            <div>
                                <img src="{{ url($article->image) }}" alt="article image" width="300px">
                            </div>
                        @else
                            <div>
                                <p>No image for this article !</p>
                            </div>
                        @endif


                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="col-2">
                                <div class="text-center">
                                    {{-- <a href="/articles/{{ $article->id }}"> --}}
                                    <a href="{{ route('articles.show', ['article' => $article->id]) }}">
                                        <button class="btn btn-info m-1">Show</button>
                                    </a>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="text-center">
                                    <a href="{{ route('articles.edit', ['article' => $article->id]) }}">
                                        <button class="btn btn-warning m-1">Edit</button>
                                    </a>
                                </div>
                            </div>

                            <div class="col-2">
                                <form action="{{ route('articles.destroy', ['article' => $article->id]) }}" method='post'>
                                    @method('delete')
                                    @csrf
                                    <button type="submit" href="#" class="btn btn-danger">Remove</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <p>no articles foundes !</p>
            @endforelse
        </div>
        <div class="mt-5 pagin">
            {{ $articles->links() }}
        </div>
    </div>



    {{-- @php
        $var = '<strong> text </strong>'
    @endphp

    <div>
        {!!$var!!}
    </div> --}}

@endsection
