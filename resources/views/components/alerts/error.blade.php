@if ($errors->any())
    <div class="mb-4 rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700">
        <ul class="list-disc list-inside space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
