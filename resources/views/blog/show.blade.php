@extends('layouts.app')

@section('title', $post->title)

@section('content')

@php
    $postImage = $post->image
        ? asset('storage/upload/products/' . optional($post->image))
        : asset('assets/images/no-images.jpeg');
@endphp

<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Kolom Konten Utama (Kiri) --}}
        <main class="w-full md:w-2/3 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md ">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4 ">{{ $post->title }}</h1>
            <p class="text-gray-600 dark:text-gray-400 text-sm mb-6 ">Posted by <span class="font-semibold">{{ $post->author->name }}</span> on {{ $post->created_at->format('F d, Y') }}</p>

            <img src="{{ $postImage }}" alt="{{ $post->title }}" class="w-full h-auto max-h-[450px] object-cover rounded-lg">

            <div class="mt-8 prose dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed text-lg">
                {!! nl2br(e($post->content)) !!}

                {{-- BAGIAN KOMENTAR BARU --}}
                <div class="mt-8 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Comments ({{ $post->comments->count() }})</h2>

                    {{-- FORM UNTUK MENAMBAH KOMENTAR --}}
                    @auth
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="content" class="sr-only">Your comment</label>
                                <textarea name="content" id="content" rows="4" class="w-full p-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Write your comment here..."></textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Post Comment</button>
                        </form>
                    @endauth

                    {{-- PESAN UNTUK USER YANG BELUM LOGIN --}}
                    @guest
                        <div class="border-l-4 border-blue-500 bg-blue-50 dark:bg-gray-700 p-4">
                            <p class="text-blue-800 dark:text-blue-300">Please <a href="{{ route('login') }}" class="font-bold underline">log in</a> to post a comment.</p>
                        </div>
                    @endguest


                    {{-- DAFTAR KOMENTAR YANG SUDAH ADA --}}
                    <div class="mt-8 space-y-6">
                        @forelse ($post->comments as $comment)
                            <div class="flex items-start gap-4">
                                {{-- Ganti dengan avatar user jika ada --}}
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&background=random&color=fff" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <div class="flex items-baseline justify-between">
                                        <p class="font-bold text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="mt-1 text-gray-700 dark:text-gray-300">
                                        {{ $comment->content }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </div>
            </div>
        </main>

        {{-- Sidebar (Kanan) --}}
        <aside class="w-full md:w-1/3">
            @include('blog.partials.sidebar')
        </aside>
    </div>
</div>
@endsection
