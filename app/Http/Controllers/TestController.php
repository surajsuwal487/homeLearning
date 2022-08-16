<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function sendMail()
    {
        $order = ['name' => 'suraj', 'product' => 'waterbottle', 'price' => '240'];
        $email = 'surajsuwal487@gmail.com';

        Mail::to($email)->send(new MyTestMail($order) );
        dd('Mail has been sent successfully');
    }
}
