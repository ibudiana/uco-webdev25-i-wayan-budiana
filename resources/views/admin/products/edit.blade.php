@extends('layouts.app')

@section('content')
<section class="pb-12 pt-12">
    <div class="container mx-auto">
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
