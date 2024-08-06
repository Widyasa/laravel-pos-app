<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionItem extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'transaction_item';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity'
    ];

    public function transactionProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
