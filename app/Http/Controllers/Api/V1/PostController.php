<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        // filtering by category
        if($request->filled('category_id')){
            $query->where('category_id', $request->category_id);
        }

        // search by title
        if($request->filled('search')){
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // load relations Orders posts by newest first 10 per page
        $posts = $query->with(['category', 'favoritedBy'])->latest()->paginate(10);

        return response()->json($posts);
    }

    public function toggleFavorite(Request $request, Post $post)
    {
        // return the authenticated Client
        $client = $request->user();

        // attaches if not present, and detaches if present.
        $client->favorites()->toggle($post->id);

        return response()->json([
            'status' => 'success',
            'message' => 'Favorite status has been updated.'
        ]);
    }

    public function showPost(Post $post)
    {
        $post->load(['category', 'favoritedBy']);

        return response()->json($post);
    }
}
