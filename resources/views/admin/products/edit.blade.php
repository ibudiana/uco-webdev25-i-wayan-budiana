@extends('layouts.admin')

@section('content')
<section class="pb-12 pt-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-products.form
                :product="$product"
                :categories="$categories"
                :brands="$brands"
                {{-- :productAttributes="$productAttributes" --}}
                action="{{ route('products.update', $product->id) }}"
                method="PUT"
            />
    </div>
</section>
@endsection
