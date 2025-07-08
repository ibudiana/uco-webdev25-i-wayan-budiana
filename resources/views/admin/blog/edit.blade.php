@extends('layouts.admin')

@section('title', 'Edit Post')

@section('content')
<div class="container mx-auto px-4 py-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-8 mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Edit Blog Post</h1>

    <form action="{{ route('blogs.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        {{-- CSRF Token --}}
        @csrf
        @method('PUT')
        {{-- Input untuk Gambar --}}
        {{-- Preview image --}}
        <div class="mb-4">
            <label for="image" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Current Featured Image</label>
            @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-48 h-48 rounded-lg mb-2">
            @else
                <img src="{{ asset('assets/images/no-images.jpeg') }}" alt="No Image" class="w-48 h-48 rounded-lg mb-2">
            @endif
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Featured Image</label>
            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="image/*">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB.</p>
            @error('image')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input untuk Judul --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Title</label>
            <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('title', $post->title) }}" required>
            @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label for="content" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Content</label>
            <textarea name="content" id="content" rows="15" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 dark:bg-gray-700 dark:text-gray-200 leading-tight focus:outline-none focus:shadow-outline" required>{{ old('content', $post->content) }}</textarea>
            @error('content')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:scale-105">Update Post</button>
            <a href="{{ route('blogs.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
        </div>
    </form>
</div>
@endsection
