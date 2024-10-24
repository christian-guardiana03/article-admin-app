<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleVersion;
use Illuminate\Http\Request;
use App\Models\Company;
use Carbon\Carbon;

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

        $article = Article::create([
            'image' => $request->image,
            'title' => $request->title,
            'link' => $request->link,
            'status' => 'For Edit',
            'date' => $request->date,
            'company_id' => $request->company_id,
            'writer_id' => auth()->user()->id,
            'content' => $request->content
        ]);

        // create version
        ArticleVersion::create([
            'article_id' => $article->id,
            'version' => 0.1
        ]);


        return redirect()->route('articles.index')->with('success', 'Article Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {   
        $companies = Company::all();
        
        return view('articles.edit', compact('article', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'image' => 'required|url',
            'title' => 'required',
            'link' => 'required|url',
            'date' => 'required|date',
            'company_id' => 'required'
        ]);

        $article->title = $request->title;
        $article->image = $request->image;
        $article->link = $request->link;
        $article->company_id = $request->company_id;
        $article->date = $request->date;
        $article->content = $request->content;

        $message = 'Article Updated Successfully!';
        if ($request->submit && $request->submit == 'publish') {
            $article->status = 'Published';
            $message = 'Article is now published!';
        }

        if (auth()->user()->getRole() == 'Editor') {
            $article->editor_id = auth()->user()->id;
        }

        $article->save();

        $changedAttributes = $article->wasChanged();

        // update version
        if ($changedAttributes) {
            $articleVersion = ArticleVersion::where('article_id', $article->id)->orderBy('created_at', 'desc')->first();
            if (!$articleVersion) {
                ArticleVersion::create([
                    'article_id' => $article->id,
                    'version' => 0.1
                ]);
            } else {
                $version = $articleVersion->version + 0.1;
                ArticleVersion::create([
                    'article_id' => $article->id,
                    'version' => $version
                ]);
            }
        }

        return redirect()->route('articles.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }
}
