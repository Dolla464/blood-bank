<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read clients', ['only' => ['index']]);
        $this->middleware('can:create clients', ['only' => ['create', 'store']]);
        $this->middleware('can:update clients', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete clients', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::with('bloodType', 'city.governorate', 'city');

        if ($request->filled('blood_type_id')){
            $query->where('blood_type_id', $request->blood_type_id);
        }

        if ($request->filled('governorate_id')){
            $query->whereHas('city.governorate', function($q) use($request){
                $q->where('id', $request->governorate_id);
            });
        }

        if ($request->filled('city_id')){
            $query->where('city_id', $request->city_id);
        }

        if ($request->has('can_donate')){
            $query->where(function($q){
                $q->whereNull('last_donation_date')
                ->orWhereRaw("DATE_ADD(last_donation_date, INTERVAL 3 MONTH) <= ?", [now()]);
            });
        }

        $clients = $query->paginate(10)->appends($request->query());

        $bloodTypes = BloodType::all();
        $governorates = Governorate::all();
        $cities = $request->filled('governorate_id')
        ? City::where('governorate_id', $request->governorate_id)->get()
        :City::all();
        return view('admin.clients.clients', compact('clients', 'bloodTypes', 'governorates', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

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
    public function show( $client_id)
    {
        $bloodType = BloodType::all();
        $city = City::all();
        $governorate = Governorate::all();

        $client = Client::findOrFail($client_id);

        return view('admin.clients.showClient', compact('client'));
    }

    // update status for a client
    public function updateStatus (Request $request, Client $client)
    {
        $request->validate([
            'status' => 'required|in:active,inactive,banned',
        ]);

        $client->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Client Status Updated successfully');
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
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client Deleted Successfully');
    }
}
