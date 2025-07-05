@extends('layouts.app')

@section('title', 'Blog')

@section('content')

@php
    $featuredImage = ($featuredPost && $featuredPost->image)
        ? asset('storage/upload/products/' . optional($featuredPost->image))
        : asset('assets/images/no-images.jpeg');
@endphp

<div class="container mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row gap-8">

        {{-- Kolom Konten Utama (Kiri) --}}
        <main class="w-full md:w-2/3">

            {{-- Postingan Unggulan --}}
            @if($featuredPost)
                 @include('blog.partials.feautured', [
                    'featuredPost' => $featuredPost,
                    'featuredImage' => $featuredImage
                ])
            @endif

            @if($posts->isEmpty())
                <div class="w-full text-center bg-white dark:bg-gray-800 p-8 md:p-12 rounded-lg shadow-md">
                    {{-- Ikon SVG --}}
                    <div class="flex justify-center items-center mb-6">
                        <svg class="w-20 h-20 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    </div>

                    {{-- Pesan Teks --}}
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white">
                        Cannot find any posts
                    </h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400 max-w-md mx-auto">
                        Don't worry, it happens. You might find other interesting articles on our homepage.
                    </p>
                </div>
            @endif

            {{-- Grid untuk Postingan Lainnya --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                @foreach($posts as $post)
                    <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden flex flex-col">
                         @if($post->image)
                            <img src="{{-- {{ asset('storage/' . $post->image) }} --}}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-xl font-bold mb-2"><a href="{{ route('blogs.show', $post->slug) }}">{{ $post->title }}</a></h2>
                            <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm">By {{ $post->author->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                            <div class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 flex-grow">
                                {{ Str::limit($post->content, 100) }}
                            </div>
                            <a href="{{ route('blogs.show', $post->slug) }}" class="text-blue-500 hover:text-blue-700 font-semibold mt-4 inline-block self-start">Read More &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Link Paginasi --}}
            <div class="mt-8">
                {{ $posts->links() }}
            </div>

        </main>

        {{-- Sidebar (Kanan) --}}
        <aside class="w-full md:w-1/3">
            @include('blog.partials.sidebar')
        </aside>

    </div>
</div>
@endsection
