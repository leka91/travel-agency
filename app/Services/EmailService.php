<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService
{
    public static function sendMail($toEmail, $mail)
    {
        Mail::to($toEmail)->send($mail);
    }
}
