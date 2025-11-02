<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read donations', ['only' => ['index']]);
        $this->middleware('can:create donations', ['only' => ['create', 'store']]);
        $this->middleware('can:update donations', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete donations', ['only' => ['destroy']]);
    }
    
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DonationRequest::with(['bloodType', 'city.governorate', 'city']);

        if ($request->filled('blood_type_id')){
            $query->where('blood_type_id', $request->blood_type_id);
        }

        if ($request->filled('governorate_id')) {
            $query->whereHas('city.governorate', function ($q) use ($request) {
                $q->where('id', $request->governorate_id);
            });
        }

        if ($request->filled('city_id')){
            $query->where('city_id', $request->city_id);
        }

        $donations = $query->paginate(10)->appends($request->query());

        $bloodTypes = BloodType::all();

        $governorates = Governorate::all();

        $cities = $request->filled('governorate_id')
        ? City::where('governorate_id', $request->governorate_id)->get()
        :City::all();
        
        return view('admin.donations.donations', compact('donations', 'bloodTypes', 'governorates', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($donation_id)
    {
        $donation = DonationRequest::findOrFail($donation_id);
        return view('admin.donations.showDonation', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donation = DonationRequest::findOrFail($id);
        $donation->delete();

        return redirect()->route('admin.donations.index')->with('success', 'Donation Request Deleted Successfully');
    }
}
