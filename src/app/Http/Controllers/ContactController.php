<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function confirm(){
        return view('confirm');
    }

    public function thanks(){
        return view('thanks');
    }
}
