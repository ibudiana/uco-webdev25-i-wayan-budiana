<div class="mb-8">
    {{-- Bagian Gambar dengan Overlay --}}
    <div class="relative mb-4">
        <img src="{{ $featuredImage }}" alt="{{ $featuredPost->title }}" class="w-full h-auto max-h-[450px] object-cover rounded-lg">

        {{-- Tag Kategori (Contoh) --}}
        <span class="absolute bottom-4 left-4 bg-red-500 text-white text-sm font-bold py-1 px-3 rounded">
            {{-- Winter Dress --}}
            {{ $featuredPost->category->name ?? 'Category' }}
        </span>

        {{-- Logo (Contoh) - Anda bisa menggantinya dengan teks atau gambar --}}
        <span class="absolute bottom-4 right-4 bg-white/80 text-gray-800 text-sm font-semibold py-1 px-3 rounded">
            Parv Infotech
        </span>
    </div>

    {{-- Konten Teks Postingan Unggulan --}}
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md -mt-16 mx-4 relative z-10">
            <h1 class="text-3xl font-bold mb-3 text-gray-900 dark:text-white">
            <a href="{{ route('blog.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
        </h1>
        <p class="text-gray-700 dark:text-gray-300 mb-4">
            {{ Str::limit($featuredPost->content, 200) }}
        </p>
        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
            <span>By {{ $featuredPost->author->name }}</span>
            <span class="mx-2">&bull;</span>
            <span>{{ $featuredPost->created_at->format('F d, Y') }}</span>
            <span class="mx-2">&bull;</span>
            <span>{{ $featuredPost->comments->count() }} Comments</span>
        </div>
    </div>
</div>
