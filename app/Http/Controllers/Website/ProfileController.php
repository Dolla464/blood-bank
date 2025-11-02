<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileDonations(Request $request)
    {
        // تحقّق بسيط للفلاتر (GET)
        $request->validate([
            'blood_type_id' => ['nullable','integer','exists:blood_types,id'],
            'city_id'       => ['nullable','integer','exists:cities,id'],
        ]);

        // قوائم الفلاتر (مرّة واحدة)
        $bloodTypes = BloodType::select('id','name')->get();
        $cities = City::select('id', 'name')
            ->where('id', Auth::guard('client-web')->user()->city_id ?? null)
            ->get();

        $clientDonations = DonationRequest::query()
        ->where('client_id', Auth::guard('client-web')->id())
        ->with(['bloodType:id,name', 'city:id,name'])
        ->when($request->filled('blood_type_id'), fn (Builder $query) =>
            $query->where('blood_type_id', $request->blood_type_id)
        )
        ->when($request->filled('city_id'), fn (Builder $query) =>
            $query->where('city_id', $request->city_id)
        )
        ->latest()
        ->paginate(5)
        ->appends($request->query());

        return view('website.profile-donations', compact('bloodTypes', 'cities', 'clientDonations'));

    }
    public function editProfile()
    {
        $bloodTypes = BloodType::all();
        $governorates = Governorate::with('cities')->get();
        return view('website.profile', compact('bloodTypes', 'governorates'));
    }

    public function updateProfile (Request $request)
    {
        /** @var Client $user */
        $user = auth('client-web')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $user->id,
            'date_of_birth' => 'required|date',
            'blood_type_id' => 'required|exists:blood_types,id',
            'governorate_id' => 'required|exists:governorates,id',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|string|max:20',
            'last_donation_date' => 'nullable|date',
            'password' => 'nullable|confirmed|min:6',
        ], [
            'required' => 'هذا الحقل مطلوب',
            'email' => 'يجب إدخال بريد إلكتروني صحيح',
            'unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',
            'confirmed' => 'تأكيد كلمة المرور غير مطابق',
            'min' => 'كلمة المرور يجب ألا تقل عن :min أحرف',
        ]);

        if (!empty($request['password'])) {
            $user->update([
                'password' => bcrypt($request['password']),
            ]);
        }

        $user->update($request->all());



        return redirect()->route('website.profile.edit')->with('success', 'تم تحديث البيانات بنجاح');
    }
}
