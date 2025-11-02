<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create()
    {
        $user = Auth::guard('client-web')->user();
        return view('website.contact_us', compact('user'));
    }

    public function store (Request $request)
    {
        if(! Auth::guard('client-web')->check()) {
            session(['url.intended' => route('website.contact_us')]);

            return redirect()->guest(route('website.register'))->with('info', 'الرجاءإنشاء حساب لإرسال الرسالة');
        }

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:5000'],
        ],[
            'title.required' => 'عنوان الرسالة مطلوب',
            'text.required'  => 'نص الرسالة مطلوب',
        ]);

        Contact::create([
            'subject' => $request->title,
            'message'  => $request->text,
            'client_id' => optional(Auth::guard('client-web')->user())->id,
        ]);

        return back()->with('success', 'تم إرسال رسالتك بنجاح، سنعاود التواصل معك قريبًا.');
    }
}
