<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackendPageController extends Controller
{
    // todo Dashboard Page
    public function dashboard()
    {
        return view('backend.admin.dashboard');
    }
}
