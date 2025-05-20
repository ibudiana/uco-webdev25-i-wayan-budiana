@extends('layouts.app')

@section('content')
<section class="pb-12 pt-12">
    <div class="container mx-auto">
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
