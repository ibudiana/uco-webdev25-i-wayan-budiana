@php
    $alertType = '';
    $alertMessage = '';

    if (session('success')) {
        $alertType = 'success';
        $alertMessage = session('success');
    } elseif ($errors->has('email')) {
        $alertType = 'error';
        $alertMessage = "The email address you entered is already subscribed.";
    }
@endphp

{{-- Hanya tampilkan modal jika ada pesan (baik itu sukses maupun error) --}}
@if ($alertMessage)
    <x-modal :name="$alertMessage" :show="true" maxWidth="lg">
        <div class="p-6">
            <div class="flex items-center">
                {{-- Tampilkan ikon berdasarkan tipe notifikasi --}}
                @if ($alertType === 'success')
                    <svg class="flex-shrink-0 w-6 h-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l1.5 1.5l3-3m-3.75 2.25a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                @elseif ($alertType === 'error')
                    <svg class="flex-shrink-0 w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                @endif
                <span class="ml-3 text-sm text-gray-700 dark:text-gray-300 font-medium">
                    {{ $alertMessage }}
                </span>
            </div>
        </div>
    </x-modal>
@endif
