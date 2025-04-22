@extends('layouts.navbar')

@section('title', 'Edit Post')

@section('content')

<div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('blogger.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl shadow-xs">
            <!-- Header Image Upload -->
            <div class="space-y-2 mb-4">
                <label class="block text-sm font-medium text-gray-700">Header Image</label>
                <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-4 h-40 flex flex-col items-center justify-center">
                    <input type="file" name="header_image" id="header_image" accept="image/*" class="hidden">
                    
                    <label for="header_image" class="cursor-pointer text-center">
                        @if($post->header_image)
                            <img id="header-image-preview" src="{{ asset('storage/' . $post->header_image) }}" class="h-40 w-auto mb-2" alt="Current header image">
                        @else
                        <svg class="mx-auto h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="mt-2 block text-sm text-gray-600">
                            Click to upload or drag and drop
                        </span>
                        <span class="mt-1 block text-xs text-gray-500">
                            PNG, JPG, GIF up to 2MB
                        </span>
                        @endif
                    </label>
                    
                    @error('header_image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-0 p-4 sm:pt-0 sm:p-7">
                <div class="space-y-4 sm:space-y-6">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="title" class="text-sm font-medium text-gray-800">Title</label>
                        <input id="title" name="title" type="text"
                            class="py-2 px-3 block w-full border-2 border-gray-300 shadow-2xs rounded-lg sm:text-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            value="{{ old('title', $post->title) }}" placeholder="Enter post title">
                        @error('title')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="space-y-2">
                        <label for="category_id" class="text-sm font-medium text-gray-800">Category</label>
                        <select id="category_id" name="category_id"
                            class="block w-full py-2 px-3 border-2 border-gray-300 rounded-lg shadow-2xs focus:border-blue-500 focus:ring focus:ring-blue-200">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="space-y-2">
                        <label for="content" class="text-sm font-medium text-gray-800">Content</label>
                        <textarea id="content" name="content"
                            class="py-2 px-3 block w-full border-2 border-gray-300 rounded-lg shadow-2xs sm:text-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            rows="15" placeholder="Write your amazing content here...">{{ old('content', $post->content ?? '') }}</textarea>
                        @error('content')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="space-y-2">
                        <label for="content_image" class="text-sm font-medium text-gray-800">Upload Image</label>
                        <label for="content_image"
                            class="group p-4 block text-center border-2 border-dashed border-gray-200 rounded-lg cursor-pointer">
                            <input id="content_image" name="content_image" type="file" class="sr-only">
                            
                            @if($post->content_image)
                                <img id="content-image-preview" src="{{ asset('storage/' . $post->content_image) }}" class="max-h-40 mx-auto mb-2" alt="Current content image">
                            @else
                            
                            <svg class="size-10 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708l2-2z"/>
                                <path
                                    d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773C16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593c.143-.863.698-1.723 1.464-2.383z"/>
                            </svg>
                            <span class="mt-2 block text-sm text-gray-800">Browse or <span class="text-blue-600 group-hover:text-blue-700">drag & drop</span></span>
                            <span class="mt-1 block text-xs text-gray-500">Max file size 2 MB(JPEG, PNG, JPG, GIF)</span>
                            
                            @endif
                        
                        </label>
                        
                        {{-- @if(isset($item) && $item->content_image)
                            <img src="{{ asset('storage/' . $post->content_image) }}" class="mt-2 max-h-40" alt="Content Image"/>
                        @endif --}}
                        
                        @error('content_image')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Reading Time -->
                    <div class="space-y-2">
                        <label for="reading_time" class="text-sm font-medium text-gray-800">Reading Time (minutes)</label>
                        <input id="reading_time" name="reading_time" type="text"
                            class="py-2 px-3 block w-full border-2 border-gray-300 shadow-2xs rounded-lg sm:text-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                            value="{{ old('reading_time', $post->reading_time) }}" placeholder="Enter reading time in minutes">
                        @error('reading_time')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-between">
                    <a href="{{ url('blogger/myposts') }}"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-300 bg-white text-gray-800 shadow hover:bg-gray-50">
                        Back
                    </a>
                    <button type="submit"
                        class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Save Post
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection