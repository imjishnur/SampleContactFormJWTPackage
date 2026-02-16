<?php

namespace Vendor\ContactForm\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Vendor\ContactForm\Models\ContactSubmission;
use Illuminate\Support\Facades\Mail;
use Vendor\ContactForm\Mail\AdminNotification;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(
            ContactSubmission::where('user_id', $request->user()->id)->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $submission = ContactSubmission::create([
            'user_id' => $request->user()?->id,
            ...$validated
        ]);

        if ($to = config('contact-form.admin_email')) {
            Mail::to($to)->queue(new AdminNotification($submission));
        }

        return response()->json(['message' => 'Submission received.', 'data' => $submission], 201);
    }
}
