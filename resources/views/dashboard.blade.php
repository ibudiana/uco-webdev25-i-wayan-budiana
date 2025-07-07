{{-- <x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> --}}

@extends('layouts.admin')

{{-- Meta Section --}}
@section('title', 'Home')

{{-- Home Content --}}
@section('content')
    <!-- START: Page Content -->
    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-5">
        <div class="p-6 text-gray-900 dark:text-gray-50">
            {{ __("Dashboard") }}
        </div>
    </div>

    <!-- Grid untuk card statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Users</h3>
            <p class="text-3xl font-bold mt-2">{{ $userCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Products</h3>
            <p class="text-3xl font-bold mt-2">{{ $productCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Orders</h3>
            <p class="text-3xl font-bold mt-2">{{ $transactionCount }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Posts</h3>
            <p class="text-3xl font-bold mt-2">{{ $blogPostCount }}</p>
        </div>
    </div>

    <!-- Tabel data -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold">Comments</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Post</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($userComments as $comment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><a href="{{ route('blogs.show', $comment->post->slug) }}">{{ $comment->post->title }}</a></td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->content }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $comment->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Page Content -->

@endsection
{{-- End Home Content --}}
