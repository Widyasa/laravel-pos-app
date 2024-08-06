<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'product';

    protected $fillable = [
        'name',
        'code',
        'price',
        'product_category_id',
        'stock'
    ];

    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function decreaseStock($quantity)
    {
        if ($this->stock < $quantity) {
            throw new \Exception('Stok tidak mencukupi');
        }

        $this->stock -= $quantity;
        $this->save();
    }
}
