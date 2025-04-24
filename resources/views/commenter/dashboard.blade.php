@extends('layouts.navbar')

@section('title', 'Commenter Dashboard')

@section('content')

<header class="flex flex-wrap lg:justify-start lg:flex-nowrap z-50 w-full py-7">
  <nav class="relative max-w-7xl w-full flex flex-wrap lg:grid lg:grid-cols-12 basis-full items-center px-4 md:px-6 lg:px-8 mx-auto">
    <div class="lg:col-span-3 flex items-center">
      

      <div class="ms-1 sm:ms-2">

      </div>
    </div>

    

    <!-- Collapse -->
    <div id="hs-navbar-hcail" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow lg:block lg:w-auto lg:basis-auto lg:order-2 lg:col-span-6" aria-labelledby="hs-navbar-hcail-collapse">
      <div class="flex flex-col gap-y-4 gap-x-0 mt-5 lg:flex-row lg:justify-center lg:items-center lg:gap-y-0 lg:gap-x-7 lg:mt-0">
        <div>
          <a class="relative inline-block text-black focus:outline-hidden before:absolute before:bottom-0.5 before:start-0 before:-z-1 before:w-full before:h-1 before:bg-lime-400" aria-current="{{ is_null($selectedCategory) ? 'page' : 'false' }}">All</a>
        </div>
        
        @foreach($categories as $category)
        <div>
            <a class="{{ $selectedCategory === $category->slug ? 'relative inline-block text-black focus:outline-hidden before:absolute before:bottom-0.5 before:start-0 before:-z-1 before:w-full before:h-1 before:bg-lime-400' : 'inline-block text-black hover:text-gray-600 focus:outline-hidden focus:text-gray-600' }}" 
               href="{{ route('commenter.dashboard', ['category' => $category->slug]) }}"
               aria-current="{{ $selectedCategory === $category->slug ? 'page' : 'false' }}">
                {{ $category->name }}
            </a>
        </div>
        @endforeach
    </div>

    </div>
    <!-- End Collapse -->
  </nav>
</header>

{{-- card blog --}}
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  {{-- Grid --}}
  <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
    @foreach($posts as $post)
    <!-- Card -->
    <a class="group block rounded-xl overflow-hidden focus:outline-hidden" href="#">
      <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
        <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
          <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" src="{{ asset('storage/' . $post->header_image) }}" alt="Header Image">
        </div>

        <div class="grow">
            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 mb-2">
                {{ $post->category->name ?? 'Uncategorized' }}
            </span>
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600">
                {{ $post->title }}
            </h3>
            <p class="mt-3 text-gray-600">
                {{ $post->excerpt }}
            </p>
            <p class="mt-4 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium">
                Read more
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
        </div>
      </div>
    </a>
    <!-- End Card -->
    @endforeach
</div>
</div>

    

    <div class="relative overflow-hidden">
      <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-20">
        <div class="text-center">
          <h1 class="text-4xl sm:text-6xl font-bold text-gray-800">
            Upgrade to Blogger
          </h1>
    
          <p class="mt-3 text-gray-600">
            Ready to share your stories with the world? Upgrade your account to publish your own posts and reach a wider audience.
          </p>

          <div class="mt-8 mb-6">
            <a class="inline-flex justify-center items-center gap-x-3 text-center bg-gradient-to-tl from-blue-600 to-violet-600 
            hover:from-blue-700 hover:to-violet-700 shadow-lg hover:shadow-blue-700/30 border border-transparent text-white text-lg font-medium 
            rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 py-3 px-8 transition-all duration-300" href="{{ route('request.blogger') }}">
              Upgrade
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    

  </div>
  <!-- End Card Blog -->

@endsection