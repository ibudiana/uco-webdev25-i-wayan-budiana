<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;


class CategoryController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Generate slug dari name
        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $counter = 1;

        // Cek apakah slug sudah ada, jika ya tambahkan angka di belakangnya
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Buat dan simpan kategori
        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->save();

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
}
