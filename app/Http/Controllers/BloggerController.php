<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class BloggerController extends Controller
{
    public function dashboard()
    {
        return view('blogger.dashboard');
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('blogger.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'reading_time' => 'nullable',
            'category_id' => 'required|exists:categories,id'
        ]);

        

        $headerImagePath = null;
        $contentImagePath = null;

        if ($request->hasFile('header_image')) {
            $headerImagePath = $request->file('header_image')->store('uploads/headers', 'public');
        }

        if ($request->hasFile('content_image')) {
            $contentImagePath = $request->file('content_image')->store('uploads/content', 'public');
        }

        // \App\Models\Post::create($validated);

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'header_image' => $headerImagePath,
            'content_image' => $contentImagePath,
            'reading_time' => $request->reading_time,
            'category_id' => $request->category_id,
            'user_id' => auth()->id()
        ]);


        return redirect()->route('blogger.create')->with('status', 'Post created successfully!');
    }

    public function myposts()
    {
        $post = Post::where('user_id', auth()->id())->latest()->get();
        return view('blogger.myposts', compact('post'));
    }

    public function edit(int $id)
    {
        $categories = \App\Models\Category::all();

        $post = Post::findOrFail($id);

        if($post->user_id !== auth()->id()){
            abort(403, 'Unauthorized action');
        }

        return view('blogger.edit', compact('post', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'header_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'reading_time' => 'nullable',
            'category_id' => 'required|exists:categories,id'
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $updateData = [];

        if ($request->filled('title') && $request->title !== $post->title) {
            $updateData['title'] = $request->title;
        }
    
        if ($request->filled('content') && $request->content !== $post->content) {
            $updateData['content'] = $request->content;
        }
    
        if ($request->filled('reading_time') && $request->reading_time !== $post->reading_time) {
            $updateData['reading_time'] = $request->reading_time;
        }
    
        if ($request->filled('category_id') && $request->category_id != $post->category_id) {
            $updateData['category_id'] = $request->category_id;
        }


        if ($request->hasFile('header_image')) {
            if($post->header_image){
                Storage::disk('public')->delete($post->header_image);
            }
            $updateData['header_image'] = $request->file('header_image')->store('uploads/headers', 'public');
        }

        if ($request->hasFile('content_image')) {
            if ($post->content_image) {
                Storage::disk('public')->delete($post->content_image);
            }
            $updateData['content_image'] = $request->file('content_image')->store('uploads/content', 'public');
        }

        $post->update($updateData);

        return redirect()->route('blogger.myposts')->with('status', 'Post Updated Successfully!');


    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('blogger.show', compact('post'));
    }
}
