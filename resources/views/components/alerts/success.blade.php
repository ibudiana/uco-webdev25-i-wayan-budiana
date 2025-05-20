@if ($message = session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded-md text-sm">
        {{ $message }}
    </div>
@endif
