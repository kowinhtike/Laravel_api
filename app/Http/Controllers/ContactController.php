<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function store(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message'=> $request->message
        ];

        Mail::send(new ContactMail($data));

        return back()->with('success',"Mail sending successfully");
    }
}
