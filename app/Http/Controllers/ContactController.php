<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    

public function send(Request $request)
{
    $data = [
        'first_name' => $request->fName,
        'last_name' => $request->lName,
        'email' => $request->emailAdd,
        'contact_number' => $request->cNumber,
        'message' => $request->userQuery,
    ];

    Mail::to('primomarcangelo@gmail.com')->send(new ContactMail($data));

    return back()->with('success', 'Email sent successfully!');
}

}
