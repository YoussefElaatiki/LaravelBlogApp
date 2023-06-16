@extends('layouts.app')

@section('content')

    <body class="bg-dark" style="--bs-bg-opacity: .1;">

        <div class="container   justify-content-between   text-center mt-5">
            <div class="row ">
                <div class="container d-flex justify-content-center align-items-center">

                    <div class="col-2">
                        <form action="{{ route('articles.index') }}" method='get'>
                            <button type="submit" href="#" class="btn btn-dark">back</button>
                        </form>

                    </div>
                </div>
                <div class="card col-5 mx-auto w-50 mt-3">
                    <div class="card-header ">
                        <p>published at: {{ $article->updated_at->diffForHumans() }}</p>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        @if ($article->image)
                            <div>
                                <img src="{{ url($article->image) }}" alt="article image" width="300px">
                            </div>
                        @else
                            <div>
                                <p>No image for this article !</p>
                            </div>
                        @endif

                        <p class="card-text">{{ $article->content }}</p>
                        <div class="d-inline">
                            @foreach ($article->categories as $category)
                                <span class="badge bg-dark">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- ------------------------------------------- comments -------------------------------------------- --}}

            <div class=" container   justify-content-center align-items-center border border-black w-50 bg-dark" style="--bs-bg-opacity: .1;">
                <form action="{{ route('articles.comments.store', ['article' => $article->id]) }}" method="post" class="container d-flex flex-row justify-content-center align-items-center">
                    @csrf


                    <div class="m-2 w-75">
                        <input type="text" class="form-control " name="comment">
                    </div>
                    <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">
                        <i class="bi bi-plus-lg my-auto mx-2"></i>
                        <p class="my-auto">comment</p>
                    </button>
                </form>
                <div>
                    {{-- {{dd($article)}} --}}
                    @forelse ($article->comments as $comment)
                        <div class=" align-items-center">
                            <div class="d-flex shadow m-3 p-3 bg-white rounded  ">
                                <span class="bg-dark text-light rounded p-2 mx-2">{{ $comment->user }} :</span>  <span class="p-2 mx-2 ">{{ $comment->content }}</span>

                                </iv>
                            </div>

                        @empty

                            <p class='text-light'>no comments yet</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endsection
