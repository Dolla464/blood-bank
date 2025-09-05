<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with('category');
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }   
        $posts = $query->paginate(10);
        $categories = Category::all();
        return view('admin.posts.posts', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;

        if ($request->hasFile('photo')){
            $image = $request->file('photo');
            $imageName = rand(1,10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/posts/"), $imageName);
            $post->photo = $imageName;
        }

        $post->save();

        $posts = Post::paginate(10);
        $lastPage = $posts->lastPage();
        return redirect()->route('posts.index', ['page' => $lastPage])->with('success', 'Post updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        

        if ($request->hasFile('photo')) {
            // delete old photo if exists
            if (File::exists(public_path('/img/posts/' . $post->photo))) {
                File::delete(public_path('/img/posts/' . $post->photo));
            }
            $image = $request->file('photo');
            $imageName = rand(1,10000) . "_" . time() . "." . $image->extension();
            $image->move(public_path("/img/posts/"), $imageName);
            
        }else{
            $imageName = $post->photo;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->photo = $imageName;
        $post->save();

        $posts = Post::paginate(10);
        $lastPage = $posts->lastPage();
        return redirect()->route('posts.index', ['page' => $lastPage, 'edit' => $post->id])->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Deleted Successfully');
    }
}
