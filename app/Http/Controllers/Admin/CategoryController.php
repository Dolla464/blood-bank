<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read categories', ['only' => ['index']]);
        $this->middleware('can:create categories', ['only' => ['create', 'store']]);
        $this->middleware('can:update categories', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete categories', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
        $total = Category::count();
        $perPage = 10; // match paginate(10)
        $lastPage = ceil($total / $perPage);
        return redirect()->route('categories.index', ['page' => $lastPage, 'add' => 'new'])->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->name = $request->name;
        $category->save();
        $total = Category::count();
        $perPage = 10; // match paginate(10)
        $lastPage = ceil($total / $perPage);
        return redirect()->route('categories.index', ['page' => $lastPage, 'edit' => $category->id])->with('success', 'Category updated successfully'); 
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        $total = Category::count();
        $perPage = 10; // match paginate(10)
        $lastPage = ceil($total / $perPage);
        return redirect()->route('categories.index', ['page' => $lastPage])->with('success', 'Category deleted successfully');
    }
}
