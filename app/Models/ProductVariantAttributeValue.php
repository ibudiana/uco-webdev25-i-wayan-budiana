<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantAttributeValue extends Model
{
    /** @use HasFactory<\Database\Factories\ProductVariantAttributeValueFactory> */
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'attribute_value_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $table = 'product_variant_attribute_values';

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
