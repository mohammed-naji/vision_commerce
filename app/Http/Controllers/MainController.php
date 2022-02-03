<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        return view('front.index');
    }

    public function shop()
    {
        return view('front.shop');
    }

    public function blog()
    {
        return view('front.blog');
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        Mail::to('admin@mohamed.com')->send(new ContactUsMail($request->except('_token')));

        return redirect()->back();
    }
}
