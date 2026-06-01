<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'email'      => 'required|email',
            'subject'    => 'required',
            'message'    => 'required|min:10',
        ]);

        ContactMessage::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
        ]);

        return redirect()
            ->route('contact.success');
    }
}