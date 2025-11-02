<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DonationController extends Controller
{
    public function index(Request $request)
    {
        // تحقّق بسيط للفلاتر (GET)
        $request->validate([
            'blood_type_id' => ['nullable','integer','exists:blood_types,id'],
            'city_id'       => ['nullable','integer','exists:cities,id'],
        ]);

        // قوائم الفلاتر (مرّة واحدة)
        $bloodTypes = BloodType::select('id','name')->get();
        $cities     = City::select('id','name')->get();

        // الاستعلام الذكي (وجود/عدم وجود فلاتر)
        $donations = DonationRequest::query()
            ->with([
                'bloodType:id,name',
                'city:id,name',
            ])
            ->when($request->filled('blood_type_id'), fn (Builder $q) =>
                $q->where('blood_type_id', $request->blood_type_id)
            )
            ->when($request->filled('city_id'), fn (Builder $q) =>
                $q->where('city_id', $request->city_id)
            )
            ->latest('id')
            ->paginate(10)
            ->appends($request->query());

        return view('website.donation-requests', compact('bloodTypes','cities','donations'));
    }

    public function show ($donation_id)
    {
        $donation = DonationRequest::findOrFail($donation_id);
        return view('website.donation-details', compact('donation'));
    }

    // public function create ()
    // {
    //     $bloodTypes = BloodType::select('id', 'name')->get();
    //     return view('website.create-donation', compact('bloodTypes'));
    // }

    public function store (Request $request)
    {
        if ($request->isMethod('get')) {
            $bloodTypes = BloodType::select('id', 'name')->get();

            return view('website.create-donation', compact('bloodTypes'));
        }

        $data = $request->validate([
            'patient_name' => 'required|string|max:255',
            'blood_type_id' => 'required|exists:blood_types,id',
            'patient_age' => 'required|integer|min:1|max:120',
            'bags_number' => 'required|integer|min:1',
            'hospital_name' => 'required|string|max:255',
            'hospital_address' => 'required|string|max:500',
            'patient_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ],[
            'patient_name.required'            => 'اسم المريض مطلوب',
            'blood_type_id.exists'     => 'فصيلة الدم غير موجودة',
            'patient_age.required'     => 'سن المريض مطلوب',
            'bags_number.required'     => 'عدد الأكياس مطلوب',
            'hospital_name.required'   => 'اسم المشفي مطلوب',
            'hospital_address.required'=> 'عنوان المشفي مطلوب',
            'patient_phone.required'   => 'رقم الجوال مطلوب',
        ]);

        $data['client_id'] = Auth::id();
        $data['city_id'] = Auth::user()->city_id;

        DonationRequest::create($data);

        return redirect()->route('website.donation-requests')->with('success', 'تم إرسال طلب التبرع بنجاح');
    }
}
