<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendContactMessageRequest;
use App\Jobs\SendEmail;
use App\Mail\ContactFormMessage;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function events()
    {
        return view('pages.events');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function sendContactMessage(SendContactMessageRequest $request)
    {
        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        SendEmail::dispatch('admin@admin.com', new ContactFormMessage($data));

        return back()->with('status', 'You have successfully sent the message');
    }
}
