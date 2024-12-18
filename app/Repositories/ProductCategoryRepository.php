<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class ProductCategoryRepository
{
    public function __construct(
        protected readonly ProductCategory $productCategory
    ){}

    public function findAll()
    {
        $search = \request('search');
        return $this->productCategory
            ->where('name', 'like', '%'.$search.'%')
            ->latest()
            ->paginate(10)
            ->withQueryString();
    }
    public function findById(int $category_id): ProductCategory {
        return $this->productCategory->where('id', $category_id)->first();
    }

    public function store($request):ProductCategory
    {
        return $this->productCategory->create($request);
    }

        public function update($request, $id): bool
        {
            $productCategory = $this->findById($id);
            return $productCategory->update($request);
        }

    public function delete($id):bool
    {
        $productCategory = $this->findById($id);
        return $productCategory->delete();
    }
}
