@extends('layouts.navbar')

@section('title', 'My Blogs')

@section('content')
<nav class="bg-white ">
    <div class="max-w-[85rem] w-full mx-auto sm:flex sm:flex-row sm:justify-between sm:items-center sm:gap-x-3 py-3 px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center gap-x-3">
        {{-- <div class="grow">
          <span class="font-semibold whitespace-nowrap text-gray-800">My project</span>
        </div> --}}
  
        <button type="button" class="hs-collapse-toggle sm:hidden py-1.5 px-2 inline-flex items-center font-medium text-xs rounded-md border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-hidden focus:bg-gray-100" data-hs-collapse="#hs-nav-secondary" aria-controls="hs-nav-secondary" aria-label="Toggle navigation">
          Overview
          <svg class="hs-dropdown-open:rotate-180 shrink-0 size-4 ms-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
        </button>
      </div>
  
      <div id="hs-nav-secondary" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
        <div class="py-2 sm:py-0 flex flex-col sm:flex-row sm:justify-end gap-y-2 sm:gap-y-0 sm:gap-x-6">
          <a class="font-medium text-sm text-blue-600 focus:outline-hidden focus:text-blue-600 " href="#">All Posts</a>
          <a class="font-medium text-sm text-gray-800 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 " href="{{ url('blogger/myposts') }}">My Posts</a>
          <a class="font-medium text-sm text-gray-800 hover:text-blue-600 focus:outline-hidden focus:text-blue-600 " href="{{ route('blogger.create') }}">Create New Post</a>
          <a class="font-medium text-sm text-gray-800 hover:text-blue-600 focus:outline-hidden focus:text-blue-600" href="#">View Profile</a>
          
        </div>
      </div>
    </div>
  </nav>
  <!-- End Nav -->

  
@endsection