<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class DashboardController extends Controller
{
    public function index() {
        
        $unpublished = Article::where('status', 'For Edit')->paginate(10);
        $published = Article::where('status', 'Published')->paginate(10);

        return view('admin.index', compact('unpublished', 'published'));
    }
}
