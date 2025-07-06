@props(['product'])

@php
    $no               = $loop->iteration;
    $name             = $user->name ?? 'Unknown';
    $email            = $user->email;
    $isActive         = $user->email_verified_at ? 'Verified' : 'Unverified';

@endphp

<tbody class="divide-y divide-gray-100 dark:divide-gray-800">
    <tr>
        {{-- Gambar + Nama Produk --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ $no }}
            </p>
        </td>

        {{-- Deskripsi --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ $name }}
            </p>
        </td>

        {{-- Harga --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-800 font-semibold dark:text-gray-400">
                {{ $email }}
            </p>
        </td>

        {{-- Status / Dummy untuk sekarang --}}
        <td class="px-5 py-4 sm:px-6">
            <p class="text-gray-800 font-semibold dark:text-gray-400">
                {{ $isActive }}
            </p>
        </td>

        {{-- Tombol --}}
        <td class="px-5 py-4 sm:px-6 text-right">
            <a href="{{ route('users.edit', $user->id) }}" class="text-amber-600 hover:text-amber-800">
                <i class="fa-solid fa-edit text-lg"></i>
            </a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-amber-600 hover:text-amber-800">
                    <i class="fa-solid fa-trash text-lg"></i>
                </button>
            </form>
        </td>
    </tr>
</tbody>
