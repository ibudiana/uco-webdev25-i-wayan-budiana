<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCardDetail extends Model
{
    /** @use HasFactory<\Database\Factories\CreditCardDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'payment_method_id',
        'cardholder_name',
        'card_number',
        'expiry_month',
        'expiry_year',
        'cvv',
        'is_default',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
