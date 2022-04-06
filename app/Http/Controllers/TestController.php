<?php

namespace App\Http\Controllers;

use App\Libraries\Sms\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// TODO: remove this controller in production
class TestController extends Controller
{
    public function index()
    {
        $response = Mail::send([], [], function ($message) {
            $message->to('a@b.com')
                ->subject('testing')
                ->setBody('hi there');
        });

        dd($response);
    }
}
