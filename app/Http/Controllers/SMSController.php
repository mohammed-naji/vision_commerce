<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SMSController extends Controller
{
    public function send()
    {
        // http://www.hotsms.ps/sendbulksms.php?user_name=test&user_pass=test&sender=test&mobile=972598683344&type=0&text=test

        Http::get('http://www.hotsms.ps/sendbulksms.php', [
            'user_name' => 'test123',
            'user_pass' => '0752800',
            'sender' => 'NidalKH',
            'mobile' => '972592418889',
            'type' => '2',
            'text' => 'تم اتمام الطلب بنجاح'
        ]);

        return 'Done';
    }
}
