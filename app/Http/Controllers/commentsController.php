<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class commentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function store(Request $request, $article)
    {
        // ----------------------------------------------- wrong method (it works) ----------------------------------------------------- //

        // $comment = Comment::create(['article_id' => $article, 'user' => Auth::user()->name, 'content' => $request->input('comment')]);
        // $article = Article::find($article);
        // $article->comments()->save($comment);

        // -------------------------------------------------------- right method  ------------------------------------------------------ //
        $comment = new Comment();
        $comment->content = $request->input('comment');
        $comment->user = Auth::user()->name;

        $article = Article::find($article);
        $comment->article()->associate($article);

        $comment->save();

        return redirect()->route('articles.show', ['article' => $article->id]);
    }



}
