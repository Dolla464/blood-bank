<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        $clientsCount = Client::count();
        $donationsCount    = DonationRequest::count();
        $bloodTypesCount   = BloodType::count();
        $citiesCount       = City::count();
        $governoratesCount = Governorate::count();
        return view('admin.home', compact('clientsCount', 'donationsCount', 'bloodTypesCount', 'citiesCount', 'governoratesCount', ));
    }
}
