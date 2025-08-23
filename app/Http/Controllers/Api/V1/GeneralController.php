<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Settings;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    use ApiResponse;

    public function bloodTypes()
    {
        $bloodTypes = BloodType::all();
        $data = [
            'bloodtypes' => $bloodTypes
        ];
        return $this->apiDataResponse($data);
    }

    public function governorates()
    {
        $governorates = Governorate::all();
        $data = [
            'governorates' => $governorates
        ];
        return $this->apiDataResponse($data);
    }

    public function cities(Request $request)
    {
        $cities = City::where(function($query) use($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id', $request->governorate_id);
            }
        })->get();
        $data = [
            'Cities' => $cities
        ];
        return $this->apiDataResponse($data);
    }
    public function settings()
    {
        $settings = Settings::first();
        $data = [
            'settings' => $settings
        ];
        return $this->apiDataResponse($data);
    }

    
}
