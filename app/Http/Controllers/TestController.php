<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'THis is title',
            'body' => 'This is another mail'
        ];
        $email = 'surajsuwal487@gmail.com';

        Mail::to($email)->send(new MyTestMail($details) );
        dd('Mail has been sent successfully');
    }
}
