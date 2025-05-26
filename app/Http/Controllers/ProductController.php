<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected function handleImageUpload(Request $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Simpan file
            $file->storeAs('upload/products', $filename, 'public');

            // Simpan nama file di product
            $image = $product->images()->create([
                'url' => $filename,
                'is_primary' => true,
            ]);

            // Set the image as primary
            $image->makePrimary();

            // Debug
            info('Image uploaded: ' . $filename);
        } else {
            info('No image file uploaded');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query();

        // Filter by search
        if ($request->has('search') && $request->search != '') {
            $products->search($request->search);
        }

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $products->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->has('brand') && $request->brand != '') {
            $products->where('brand_id', $request->brand);
        }

        // Filter by max price
        if ($request->has('min_price') && $request->min_price != '') {
            $products->where('price', '>=', $request->min_price);
        }

        // Filter by max price
        if ($request->has('max_price') && $request->max_price != '') {
            $products->where('price', '<=', $request->max_price);
        }

        // Fetch all products with their related images, variants, attributes, categories, and brand
        $products = $products->with(['brand', 'category', 'images', 'variants.attributeValues.attribute'])->paginate(10);

        // Get Categories and Brands
        $categories = Category::all();
        $brands = Brand::all();

        if (Auth::check() && Auth::user()->hasVerifiedEmail()) {
            // Admin View
            return view('admin.products.index', compact('products', 'categories', 'brands'));
        } else {
            // Guest View
            return view('products.index', compact('products', 'categories', 'brands'));
        }

        // return view('products.index', compact('products', 'categories', 'brands'));
        // Return the products as a JSON response
        // return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create product
        $categories = Category::all();
        $brands = Brand::all();

        $product = new Product();
        $product->setRelation('variants', collect());

        return view('admin.products.create', compact('product', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //store product
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        $this->handleImageUpload($request, $product);

        // return redirect()->route('products.index')->with('success', 'Product created successfully.');
        return redirect()
            ->route('products.index', $request->slug)
            ->with('success', 'Product create successfully.');
    }

    /**
     * Display the specified resource.
     */
    // show by id
    // public function show(string $id)
    // {
    //     //Show product by id
    //     $product = Product::with(['brand', 'category', 'images', 'variants.attributeValues.attribute'])->find($id);
    //     if (!$product) {
    //         return response()->json(['message' => 'Product not found'], 404);
    //     }
    //     return response()->json($product);
    // }

    // show by slug
    public function show(string $slug)
    {
        //Show product by slug
        $product = Product::with(['brand', 'category', 'images', 'variants.attributeValues.attribute'])->where('slug', $slug)->firstOrFail();
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        // return response()->json($product);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        //Edit product
        $product                = Product::with(['brand', 'category', 'images', 'variants.attributeValues.attribute'])->where('slug', $slug)->firstOrFail();
        $categories             = Category::all();
        $brands                 = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
        // return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:products,slug,' . $id,
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ]);

        $this->handleImageUpload($request, $product);

        // return redirect()->route('products.index')->with('success', 'Product updated successfully.');

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        //Delete product
        $product = Product::where('slug', $slug)->firstOrFail();
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
