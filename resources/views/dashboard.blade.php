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
            <h3 class="text-sm font-medium text-gray-500">Total Pengguna</h3>
            <p class="text-3xl font-bold mt-2">1,257</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Pendapatan Hari Ini</h3>
            <p class="text-3xl font-bold mt-2">Rp 2.5jt</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Pesanan Baru</h3>
            <p class="text-3xl font-bold mt-2">84</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-sm font-medium text-gray-500">Tiket Bantuan</h3>
            <p class="text-3xl font-bold mt-2">12</p>
        </div>
    </div>

    <!-- Tabel data -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-4 border-b">
            <h2 class="text-xl font-semibold">Pengguna Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Budi Santoso</td>
                        <td class="px-6 py-4 whitespace-nowrap">UI/UX Designer</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span></td>
                        <td class="px-6 py-4 whitespace-nowrap">Admin</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Citra Lestari</td>
                        <td class="px-6 py-4 whitespace-nowrap">Developer</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aktif</span></td>
                        <td class="px-6 py-4 whitespace-nowrap">Member</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">Agus Wijaya</td>
                        <td class="px-6 py-4 whitespace-nowrap">Project Manager</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Nonaktif</span></td>
                        <td class="px-6 py-4 whitespace-nowrap">Member</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END: Page Content -->

@endsection
{{-- End Home Content --}}
