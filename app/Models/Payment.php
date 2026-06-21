<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    protected $table = 'payment';
    protected $fillable = ['booking_id', 'payment_code', 'amount', 'method', 'status', 'transaction_id', 'payment_detail', 'notes', 'paid_at'];
    protected $casts = ['payment_detail' => 'array', 'paid_at' => 'datetime', 'amount' => 'decimal:2'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($payment) {
            if (!$payment->payment_code) {
                $payment->payment_code = 'PAY-' . strtoupper(Str::random(12));
            }
        });
    }

    public function methodIcon()
    {
        return match ($this->method) {
            'bank_transfer'   => 'bi bi-bank',
            'virtual_account' => 'bi bi-credit-card-2-front',
            'e_wallet'        => 'bi bi-phone',
            'qris'            => 'bi bi-qr-code-scan',
            'credit_card'     => 'bi bi-credit-card',
            'debit_card'      => 'bi bi-credit-card-2-back',
            default           => 'bi bi-wallet2',
        };
    }

    public function methodLabel()
    {
        return match ($this->method) {
            'bank_transfer'   => 'Bank Transfer',
            'virtual_account' => 'Virtual Account',
            'e_wallet'        => 'E-Wallet',
            'qris'            => 'QRIS',
            'credit_card'     => 'Kartu Kredit',
            'debit_card'      => 'Kartu Debit',
            default           => ucfirst(str_replace('_', ' ', $this->method)),
        };
    }

    public function booking() { return $this->belongsTo(Booking::class); }
}
