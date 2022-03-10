<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
class MailController extends Controller
{
    public function sendEmail($email)
    {
        Mail::to($email)->send(new SendMail());
    }
}
