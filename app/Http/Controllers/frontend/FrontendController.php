<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // todo Home Page
    public function index()
    {
        return view('welcome');
    }

    // todo Login Page
    public function login()
    {
        return view('frontend.login');
    }
}
