<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read messages', ['only' => ['index']]);
        $this->middleware('can:create messages', ['only' => ['create', 'store']]);
        $this->middleware('can:update messages', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete messages', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Contact::paginate(10);
        return view('admin.messages.messages', compact('messages'));
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
    public function show($message_id)
    {
        $message = Contact::findOrFail($message_id);
        return view('admin.messages.showMessage', compact('message'));
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
        $message = Contact::findOrFail($id);
        $message->delete();

        return redirect()->route('messages.index')->with('success', 'Message Deleted Successfully');
    }
}
