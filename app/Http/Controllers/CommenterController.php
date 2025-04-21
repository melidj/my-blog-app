<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CommenterController extends Controller
{
    public function dashboard()
    {
        return view('commenter.dashboard');
    }

    public function showUpgradeForm()
    {
        $categories = Category::all();
        return view('commenter.request-blogger', compact('categories'));
        // return view('commenter.request-blogger', compact('categories'));
    }

    public function upgradeToBlogger(Request $request) 
    {
        $request->validate([
            'blogger_name' =>'required|string|max:255',
            'categories' => 'required|array',
        ]);


        Auth::user()->update([
            'blogger_name' => $request->blogger_name,
            'bio' => $request->bio,
            'role' => 'blogger',
        ]);

        return redirect()->route('blogger.dashboard');
    }
    
}
