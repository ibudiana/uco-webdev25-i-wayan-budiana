@props(['product'])

@php
    $image = ($post->image)
        ? asset('storage/' . $post->image)
        : asset('assets/images/no-images.jpeg');
    $title          = $post->title;
    $desc           = Str::limit(strip_tags($post->content), 60);
    $url            = route('blogs.show', $post->slug);
    $author         = $post->author->name ?? 'Unknown';
    $comments_count = $post->comments->count();

@endphp

<tbody class="divide-y divide-gray-100 dark:divide-gray-800">
    <tr>
        {{-- Gambar + Nama Produk --}}
        <td class="px-5 py-4 sm:px-6">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 overflow-hidden rounded-full">
                    <img src="{{ $image }}" alt="product" class="object-cover w-full h-full">
                </div>
                <div>
                    <span class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                        <a href="{{ $url }}" class="hover:underline">{{ $title }}</a>
                    </span>
                </div>
            </div>
        </td>

        {{-- Deskripsi --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ $desc }}
            </p>
        </td>

        {{-- Harga --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-800 font-semibold dark:text-gray-400">
                {{ $author }}
            </p>
        </td>

        {{-- Status / Dummy untuk sekarang --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-800 font-semibold dark:text-gray-400">
                {{ $comments_count ?? 0 }}
            </p>
        </td>

        {{-- Tombol --}}
        <td class="px-5 py-4 sm:px-6 text-right">
            <a href="{{ route('blogs.edit', $post->slug) }}" class="text-amber-600 hover:text-amber-800">
                <i class="fa-solid fa-edit text-lg"></i>
            </a>
            <form action="{{ route('blogs.destroy', $post->slug) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-amber-600 hover:text-amber-800">
                    <i class="fa-solid fa-trash text-lg"></i>
                </button>
            </form>
        </td>
    </tr>
</tbody>
