<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected readonly ProductCategoryRepository $productCategory,
        protected readonly ProductRepository $product
    )
    {}

    public function index() {
        $products = $this->product->findAll();
        return ApiResponse::success([
            $products
        ], 'Fetched', 'Product');
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->product->store($request->validated());
            return ApiResponse::success([$product], 'Create', 'Product');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Create', 'Product');
        }
    }

    public function show($id)
    {
        $product = $this->product->findById($id);
        return ApiResponse::success([
            $product
        ], 'Fetched', 'Product');
    }
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = $this->product->update($request->validated(), $id);
            return ApiResponse::success([
                'data' => $product
            ], 'Update', 'Product');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Create', 'Product');
        }

    }
    public function delete($id)
    {
        try {
            $product = $this->product->delete($id);
            return ApiResponse::success([
                'data' => $product
            ], 'Delete', 'Product');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Delete', 'Product');
        }
    }
}
