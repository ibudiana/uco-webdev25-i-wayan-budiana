<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
        'brand_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'formatted_price',
    ];

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
    }

    public function scopeFilter($query, $filters)
    {
        dd($filters);

        if ($filters['search'] ?? false) {
            $query->search($filters['search']);
        }
        if ($filters['category'] ?? false) {
            $query->where('category_id', $filters['category']);
        }

        if ($filters['brand'] ?? false) {
            $query->where('brand_id', $filters['brand']);
        }

        if ($filters['price_min'] ?? false) {
            $query->where('price', '>=', $filters['price_min']);
        }

        if ($filters['price_max'] ?? false) {
            $query->where('price', '<=', $filters['price_max']);
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }
}
