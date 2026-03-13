<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CallbackRequest;
use App\Mail\CallbackRequested;
use Illuminate\Support\Facades\Mail;

class CallbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'min:3',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|email|max:255',
            'service' => 'required|string',
            'phone' => ['required', 'string', 'regex:/^[0-9]{11}$/'],
            'message' => 'required|string',
        ], [
            'name.regex' => 'The name must only contain letters and spaces.',
            'name.min' => 'The name must be at least 3 letters.',
            'phone.regex' => 'The phone number must be 11 digits.',
        ]);

        // Save to Database
        $callbackRequest = CallbackRequest::create($validated);

        // Send Email
        Mail::to('mahassan082@gmail.com')->send(new CallbackRequested($validated));

        return back()->with('success', 'Your callback request has been sent successfully!');
    }
}
