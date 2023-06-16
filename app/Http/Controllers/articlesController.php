<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\article;

class articlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        return redirect('/articles');
    }

    public function index()
    {

        $articles = article::with('categories')->paginate(6);

        return view('articles', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\category::all();
        return view('addArticle', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'categories' => 'required',
        ]);

        $article = new Article;
        $article->title = $request->input('title');
        $article->content = $request->input('content');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images');
            $article->image = $path;
        }

        $article->save();

        $categories = $request->input('categories');
        $article->categories()->attach($categories);

        return redirect()->route('articles.index');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = article::with('categories')->with('comments')->find($id);

        return view('article', ['article' => $article] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = article::find($id);
        $selectedCategories = $article->categories->pluck('id')->toArray();


        $categories = \App\Models\category::all();

        return view('updateArticle', ['article' => $article, 'categories' => $categories, 'selectedCategories' => $selectedCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'categories' => 'required',
        ]);

        $article = article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images');
            $article->image = $path;
        }

        $article->save();

        $categories = $request->input('categories');
        $article->categories()->sync($categories);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = article::find($id);
        $article->delete();
        return redirect('/articles');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search');
        $articles = article::with('categories')->where('title', 'LIKE', "%$searchQuery%")
            ->orWhere('content', 'LIKE', "%$searchQuery%")
            ->paginate(6);

        return view('search', ['articles' => $articles]);
    }


}
