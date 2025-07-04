
<div class="sticky top-8">
    {{-- Kotak Pencarian --}}
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md mb-8">
        <h3 class="font-bold text-lg mb-4 dark:text-white">SEARCH</h3>
        <form action="{{ route('blog.index') }}" method="GET" class="flex">
            <input type="text" name="search" placeholder="Searching..." class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-800 rounded-l-md focus:ring-blue-500 focus:border-blue-500">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold p-3 rounded-r-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </button>
        </form>
    </div>

    {{-- Postingan Terbaru --}}
    <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-lg mb-4 dark:text-white">RECENT POSTS</h3>
        <div class="space-y-4">
            @foreach($recentPosts as $recent)
                <div class="flex items-center">
                    <img
                        src="{{ $recent->image ? asset('storage/' . $recent->image) : asset('assets/images/no-images.jpeg') }}"
                        alt="{{ $recent->title }}"
                        class="w-16 h-16 object-cover rounded-md mr-4"
                    >
                    <div>
                        <h4 class="font-semibold leading-tight dark:text-white">
                            <a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->title }}</a>
                        </h4>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $recent->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

