@extends('layouts.app')

@section('content')

    <div class="container   justify-content-between   text-center mt-5">
        <div class="row ">
            <div class="col-2">
                <form action="{{ route('articles.index') }}" method='get'>
                    <button type="submit" href="#" class="btn btn-dark">back</button>
                </form>

            </div>
            <h2>Search Results:</h2>

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
                                <form action="{{ route('articles.show', ['article' => $article]) }}" method='get'>
                                    @csrf
                                    <button type="submit" href="#" class="btn btn-info m-1">show</button>
                                </form>
                            </div>

                            <div class="col-2">
                                <form action="{{ route('articles.edit', ['article' => $article->id]) }}" method='get'>
                                    @csrf
                                    <button type="submit" href="#" class="btn btn-warning m-1">Edit</button>
                                </form>
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

@endsection
