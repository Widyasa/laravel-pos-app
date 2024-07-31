<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\StoreCartRequest;
use App\Models\Product;
use App\Repositories\CartRepository;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected readonly CartRepository $cart
    )
    {}

    public function index()
    {
        $carts = $this->cart->findAll();
        return ApiResponse::success([
            'carts' => $carts
        ], 'Fetched', 'Cart');
    }

    public function store(StoreCartRequest $request)
    {
        try {
            $cart = $this->cart->store($request->validated());
            return ApiResponse::success([$cart], 'Create', 'Cart');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Create', 'Cart');
        }
    }
}
