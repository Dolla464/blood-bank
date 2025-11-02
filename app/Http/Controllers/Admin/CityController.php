<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read cities', ['only' => ['index']]);
        $this->middleware('can:create cities', ['only' => ['create', 'store']]);
        $this->middleware('can:update cities', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete cities', ['only' => ['destroy']]);
    }
    
    public function index(Request $request)
    {
        $query = City::with('governorate');
        if ($request->filled('governorate_id')) {
            $query->where('governorate_id', $request->governorate_id);
        }
        $cities = $query->paginate(10)->appends($request->query());
        $governorates = Governorate::all();
        return view('admin.Cities.cities', compact('cities', 'governorates'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        return view('admin.Cities.create', compact('governorates'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name',
            'governorate_id' => 'required|exists:governorates,id',
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->governorate_id = $request->governorate_id;
        $city->save();

        $total = City::count();
        $perPage = 10; // match paginate(10)
        $lastPage = ceil($total / $perPage);

        return redirect()->route('admin.cities.index', ['page' => $lastPage, 'add' => 'new'])->with('success', 'City created successfully');
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $governorates = Governorate::all();
        return view('admin.Cities.edit', compact('city', 'governorates'));
    }   

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255|unique:cities,name,' . $city->id,
            'governorate_id' => 'required|exists:governorates,id',
        ]);

        $city->name = $request->name;
        $city->governorate_id = $request->governorate_id;
        $city->save();

        $page = $request->query('page', 1);
        return redirect()->route('admin.cities.index', ['page' => $page])->with('success', 'City updated successfully');
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        $page = request()->query('page', 1);
        return redirect()->route('admin.cities.index', ['page' => $page])->with('success', 'City deleted successfully');
    }
}
