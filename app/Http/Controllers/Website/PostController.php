<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function posts()
    {
        $posts = Post::latest()->paginate(9);
        return view('website.articles', compact('posts'));
    }

    public function show ($id)
    {
        $post = Post::findOrFail($id);
        $posts = Post::all();
        return view('website.article-details', compact('post', 'posts'));
    }
}
