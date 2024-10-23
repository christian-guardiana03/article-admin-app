<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Company;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        $articles = Article::all();

        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $companies = Company::all();
        return view('articles.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|url',
            'title' => 'required',
            'link' => 'required|url',
            'date' => 'required|date',
            'company_id' => 'required'
        ]);

        Article::create([
            'image' => $request->image,
            'title' => $request->title,
            'link' => $request->link,
            'status' => 'For Edit',
            'date' => $request->date,
            'company_id' => $request->company_id,
            'writer_id' => auth()->user()->id,
            'content' => $request->content
        ]);


        return redirect()->route('articles.index')->with('success', 'Article Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
