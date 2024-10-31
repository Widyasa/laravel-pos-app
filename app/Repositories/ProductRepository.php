<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\QueryException;
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
        $search = \request('search');
        return $this->product
            ->with('product_category')
            ->where('name', 'like', '%'.$search.'%')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
    public function findById(int $product_id): Product {
        return $this->product->where('id', $product_id)->with('product_category')->first();
    }

    public function store($request):Product
    {
        DB::beginTransaction();
        try{
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $request['code'] = 'PRD - ' . date('dmYHis');
            DB::commit();
            return $this->product->create($request);
        } catch (QueryException $e){
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
