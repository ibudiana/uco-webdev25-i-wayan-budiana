<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function makeDefaultPaymentMethod($value)
    {
        // nonaktifkan semua metode pembayaran lain jika ini adalah default
        if ($value) {
            self::where('user_id', $this->user_id)
                ->where('id', '!=', $this->id)
                ->update(['is_default' => false]);
        }

        return $value;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bankTransfers()
    {
        return $this->hasMany(BankTransfer::class);
    }
}
