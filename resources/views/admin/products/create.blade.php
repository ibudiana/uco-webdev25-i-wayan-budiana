@extends('layouts.admin')

@section('content')
<section class="pb-12 pt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-products.form
                :product="null"
                :categories="$categories"
                :brands="$brands"
                action="{{ route('products.store') }}"
                method="POST"
            />
    </div>
</section>
@endsection


{{-- <x-admin-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-products.form
                        :product="null"
                        :categories="$categories"
                        :brands="$brands"
                        action="{{ route('products.store') }}"
                        method="POST"
                    />
                </div>
            </div>
        </div>
    </div>
</x-admin-layout> --}}
