<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductRepository
{
    public function __construct(
        protected readonly ProductCategory $productCategory,
        protected readonly Product $product
    ){}

    public function findAll()
    {
        return $this->product->with('product_category')->latest()->paginate(10);
    }
    public function findById(int $product_id): Product {
        return $this->product->where('id', $product_id)->with('product_category')->first();
    }

    public function store($request):Product
    {
        DB::beginTransaction();
        try{
            $request['code'] = Str::random(4);
            DB::commit();
            return $this->product->create($request);
        } catch (\Illuminate\Database\QueryException $e){
            logger($e->getMessage());
            DB::rollBack();
            throw $e;
        }
    }

    public function update($request, $id): bool
    {
        $product = $this->findById($id);
        return $product->update($request);
    }

    public function delete($id):bool
    {
        $product = $this->findById($id);
        return $product->delete();
    }
}