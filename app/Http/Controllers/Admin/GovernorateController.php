<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:read governorates', ['only' => ['index']]);
        $this->middleware('can:create governorates', ['only' => ['create', 'store']]);
        $this->middleware('can:update governorates', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete governorates', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Fetch governorates directly from the model
        $governorates = Governorate::paginate(10); // 10 items per page
        return view('admin.Governorates.governorates', compact('governorates'));
    }

    public function create()
    {
        // Logic to show the form for creating a new governorate
        return view('admin.Governorates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $governorate = new Governorate();
        $governorate->name = $request->name;
        $governorate->save();
        $total = Governorate::count();
        $perPage = 10; // match paginate(10)
        $lastPage = ceil($total / $perPage);
        return redirect()->route('governorates.index', ['page' => $lastPage, 'add' => 'new'])->with('success', 'Governorate created successfully');
    }

    public function edit(Governorate $governorate)
    {
        return view('admin.Governorates.edit', compact('governorate'));
    }

    public function update(Request $request, Governorate $governorate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $governorate->name = $request->name;
        $governorate->save();
        $page = $request->query('page', 1);
        return redirect()->route('governorates.index', ['page' => $page])->with('success', 'Governorate updated successfully');
    }

    public function destroy(Request $request, Governorate $governorate)
    {
        $governorate->delete();
        $page = $request->query('page', 1);
        return redirect()->route('governorates.index', ['page' => $page])->with('success', 'Governorate deleted successfully');
    }
}
