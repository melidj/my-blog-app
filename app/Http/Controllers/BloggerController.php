<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BloggerController extends Controller
{
    public function dashboard()
    {
        return view('blogger.dashboard');
    }
}
