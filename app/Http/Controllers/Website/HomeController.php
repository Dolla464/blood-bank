<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Post;

class HomeController extends Controller
{
    public function index() 
    {
        $bloodTypes = BloodType::all();
        $cities = City::all();
        $posts = Post::latest()->get();
        $donations = DonationRequest::latest()->take(4)->get();

        
        return view('website.home', compact('posts', 'donations','bloodTypes', 'cities'));
    }
}
