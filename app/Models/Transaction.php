<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'transaction';
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'total_payment',
        'total_exchange'
    ];

    public function transactionProduct()
    {
        return $this->belongsTo(TransactionItem::class, 'transaction_id');
    }
}
