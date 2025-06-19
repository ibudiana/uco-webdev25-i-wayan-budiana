@props(['product', 'categories', 'brands', 'productAttributes', 'action', 'method'])

@php
    $primaryImage = optional($product)->images ? $product->images->firstWhere('is_primary', 1) : null;

    $image = $primaryImage && $primaryImage->url
        ? asset('storage/upload/products/' . $primaryImage->url)
        : asset('assets/images/no-images.jpeg');
@endphp

<form action="{{ $action }}" method="POST" class="space-y-6" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div x-data="{ mainImage: '{{ $image }}' }" class="max-w-lg mx-auto">

        <!-- Gambar utama -->
        <div class="mb-4">
            <img :src="mainImage" alt="Product Image" class="w-full h-96 object-cover rounded shadow-md transition-transform duration-300 hover:scale-105" />
        </div>


        <!-- Thumbnail gallery -->
        <div class="flex space-x-2 overflow-x-auto">
            @foreach (optional($product)->images as $thumb)
                <div class="relative">
                    <button
                        type="button"
                        @click="mainImage = '{{ asset('storage/upload/products/' . $thumb->url) }}'"
                        class="border rounded overflow-hidden focus:outline-none focus:ring-2 focus:ring-amber-500"
                    >
                        <img src="{{ asset('storage/upload/products/' . $thumb->url) }}" alt="Thumbnail" class="w-20 h-20 object-cover hover:brightness-90" />
                    </button>

                    <button type="button" onclick="submitDeleteForm({{ $thumb->id }})" class="text-red-600 text-xs hover:underline absolute top-1 right-1">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-span-full">
        <label for="product-image" class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Product Image</label>
        <div x-data="imagePreview()"  class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 dark:border-gray-50/25 px-6 py-10">
            <div class="text-center">

                <template x-if="imageUrl">
                    <img :src="imageUrl" class="mx-auto max-h-64 mb-4 rounded shadow" />
                </template>
                <svg
                    x-show="!imageUrl"
                    class="mx-auto size-12 text-gray-300"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                >
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd"></path>
                </svg>
                <!-- Input Upload -->
                <div class="mt-4 flex text-sm text-gray-900 dark:text-gray-50">
                    <label for="image" class="relative cursor-pointer text-amber-800 dark:text-amber-300">
                        <span>Upload a file</span>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            class="sr-only"
                            accept="image/*"
                            @change="fileChosen"
                        >
                    </label>
                    <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-900 dark:text-gray-50">PNG, JPG, GIF up to 10MB</p>
            </div>
        </div>
    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Name</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $product->slug ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Category</label>
        <select name="category_id" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <!-- Tombol tambah kategori -->
        <button type="button" onclick="openAddCategoryModal()" class="mt-2 text-sm text-amber-600 hover:underline">
            + Tambah Kategori Baru
        </button>

    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Brand</label>
        <select name="brand_id" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id ?? '') == $brand->id)>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mt-2">
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="description" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Price</label>
        <input type="number" name="price" value="{{ old('price', isset($product->price) ? floor($product->price) : 0) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
    </div>

    <div>
        <label class="block text-sm/6 font-medium text-gray-900 dark:text-gray-50">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-amber-600 sm:text-sm/6">
    </div>


    @if (isset($product) && $product->variants->isNotEmpty())
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-50">Variants</h2>
            <div class="space-y-4">
                @foreach ($product->variants as $index => $variant)
                    <div class="bg-gray-100 dark:bg-gray-900 rounded-lg p-4 shadow-sm space-y-4">

                        <!-- SKU -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">SKU</label>
                            <input type="text" name="variants[{{ $index }}][sku]" value="{{ old("variants.{$index}.sku", $variant->sku) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="text" name="variants[{{ $index }}][price]" value="{{ old("variants.{$index}.price", isset($variant->price) ? floor($variant->price) : 0) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="text" name="variants[{{ $index }}][stock]" value="{{ old("variants.{$index}.stock", $variant->stock) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        </div>

                         <!-- Attribute Selects -->
                         <div class="flex flex-wrap gap-4">
                            @foreach ($variant->attributeValues as $attrValue)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        {{ $attrValue->attribute->name }}
                                    </label>
                                    <select name="variants[{{ $index }}][attribute_values][]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        @foreach ($attrValue->attribute->attributeValues as $option)
                                            <option value="{{ $option->id }}"
                                                @selected($option->id == $attrValue->id)>
                                                {{ $option->value }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <x-alerts.error />

    <div>
        <button type="submit" class="rounded-md bg-amber-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-amber-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-600">
            {{ $method === 'PUT' ? 'Update Product' : 'Create Product' }}
        </button>
    </div>
</form>

<x-modal.add-category/>

@foreach (optional($product)->images as $thumb)
    <form id="delete-form-{{ $thumb->id }}" action="{{ route('product.image.delete', $thumb->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
@endforeach

<script>
    function submitDeleteForm(id) {
        if (confirm('Delete this image?')) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    }
</script>
