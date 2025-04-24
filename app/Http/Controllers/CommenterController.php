<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CommenterController extends Controller
{
    public function dashboard(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = request('category');
    
        $posts = Post::with('category')
            ->when($selectedCategory, function ($query) use ($selectedCategory) {
                return $query->whereHas('category', function ($q) use ($selectedCategory) {
                    $q->where('slug', $selectedCategory);
                });
            })
            ->latest()
            ->paginate(6);
    
        return view('commenter.dashboard', compact('posts', 'categories', 'selectedCategory'));
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

        $user = Auth::user();

        $user->update([
            'blogger_name' => $request->blogger_name,
            'bio' => $request->bio,
            'role' => 'blogger',
        ]);

        return redirect()->route('blogger.dashboard');
    }

    public function show(Post $post)
    {
        return view('commenter.show', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }
    
}
