<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategory\StoreProductCategoryRequest;
use App\Http\Requests\ProductCategory\UpdateProductCategoryRequest;
use App\Models\ProductCategory;
use App\Repositories\ProductCategoryRepository;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct(
        protected readonly ProductCategoryRepository $productCategory
    )
    {}

    public function index() {
        $categories = $this->productCategory->findAll();
        return ApiResponse::success([
            'categories' => $categories
        ], 'Fetched', 'Product Cateogries');
    }

    public function store(StoreProductCategoryRequest $request)
    {
        try {
            $categoryProduct = $this->productCategory->store($request->validated());
            return ApiResponse::success([$categoryProduct], 'Create', 'Product Category');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Create', 'Product Category');
        }
    }

    public function show($id)
    {
        $category = $this->productCategory->findById($id);
        return ApiResponse::success([
            'data' => $category
        ], 'Fetched', 'Product Category');
    }
    public function update(UpdateProductCategoryRequest $request, $id)
    {
        $category = $this->productCategory->update($request->validated(), $id);
        return ApiResponse::success([
            'data' => $category
        ], 'Update', 'Product Category');
    }
    public function delete($id)
    {
        $category = $this->productCategory->delete($id);
        return ApiResponse::success([
            'data' => $category
        ], 'Delete', 'Product Category');
    }

}
