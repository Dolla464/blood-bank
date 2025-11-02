<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginView () 
    {
        return view('website.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ],[
            'login.required' => 'رقم الهاتف أو البريد الإلكتروني مطلوب',
            'password.required' => ' كلمة المرور مطلوبة'
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
        $login_type => $request->input('login'),
        'password' => $request->input('password'),
        ];

        if (Auth::guard('client-web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('website.home'));
        }

        return back()->withErrors(['login' => 'البيانات التي أدخلتها غير مسجلة لدينا.',])->onlyInput('login');
        // login with phone only
        // if (Auth::guard('client-web')->attempt($credentials, $request->boolean('remember'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended(route('website.home'));
        // }

        // return back()->withErrors([
        //     'phone' => 'البيانات التي أدخلتها بها خطأ',
        // ])->onlyInput('phone');
    }

    public function registerView(Request $request)
    { 
        return view('website.auth.register');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            $governorates = Governorate::select('id', 'name')->get();
            $bloodTypes = BloodType::select('id', 'name')->get();

            $cities = collect();
            if (old('governorate_id')) {
                $cities = City::where('governorate_id', old('governorate_id'))->select('id', 'name')->get();
            }

            return view('website.auth.register', compact('governorates', 'bloodTypes', 'cities'));
        }

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'nullable|email|max:255|unique:clients,email',
            'birthday_date'    => 'required|date',
            'blood_type_id'    => 'required|exists:blood_types,id',
            'governorate_id'   => 'required|exists:governorates,id',
            'city_id'          => 'required|exists:cities,id',
            'phone'            => 'required|string|max:15|unique:clients,phone',
            'last_donation_at' => 'nullable|date',
            'password'         => 'required|confirmed|min:6',
        ],[
            'name.required'            => 'الاسم مطلوب',
            'email.email'              => 'صيغة البريد الإلكتروني غير صحيحة',
            'email.unique'             => 'هذا البريد مستخدم بالفعل',
            'birthday_date.required'   => 'تاريخ الميلاد مطلوب',
            'birthday_date.date'       => 'صيغة التاريخ غير صحيحة',
            'blood_type_id.required'   => 'فضلاً اختر فصيلة الدم',
            'blood_type_id.exists'     => 'فصيلة الدم غير موجودة',
            'governorate_id.required'  => 'فضلاً اختر المحافظة',
            'governorate_id.exists'    => 'المحافظة غير موجودة',
            'city_id.required'         => 'فضلاً اختر المدينة',
            'city_id.exists'           => 'المدينة المختارة لا تتبع المحافظة المحددة',
            'phone.required'           => 'رقم الهاتف مطلوب',
            'phone.unique'             => 'رقم الهاتف مستخدم بالفعل',
            'password.required'        => 'كلمة المرور مطلوبة',
            'password.confirmed'       => 'تأكيد كلمة المرور غير مطابق',
            'password.min'             => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
        ]);

        // Map request keys to DB column names
        $payload = [
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'date_of_birth' => $validated['birthday_date'],
            'blood_type_id' => $validated['blood_type_id'],
            'city_id' => $validated['city_id'],
            'phone' => $validated['phone'],
            'last_donation_date' => $validated['last_donation_at'] ?? null,
            'password' => $validated['password'], // hashed by model mutator
        ];

        $client = Client::create($payload);

        Auth::guard('client-web')->login($client);
        $request->session()->regenerate();
        
        return redirect()->route('website.home')->with('success', 'تم إنشاء الحساب بنجاح');
    }

    public function fetchCities(Request $request)
    {
        $request->validate([
            'governorate_id' => 'required|integer|exists:governorates,id',
        ]);

        $cities = City::where('governorate_id', $request->governorate_id)->select('id', 'name')->get();
        return response()->json([
            'status' => 1,
            'data' => $cities,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('client-web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('website.home')->with('success', 'تم تسجيل الخروج بنجاح');
    }
}
