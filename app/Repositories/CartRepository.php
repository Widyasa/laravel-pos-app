<?php

namespace App\Repositories;

use App\Models\Product;

class CartRepository
{
    public function __construct(
        protected readonly Product $product
    )
    {}

    public function store($request)
    {
//        dd($request['product_id']);
            $product = $this->product->findOrFail($request['product_id']);
            $cart = session()->get('cart', []);
            if (isset($cart[$request['product_id']])) {
                $cart[$request['product_id']]['quantity']++;
            } else {
                $cart[$request['product_id']] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => (int) $request['quantity'],
                ];
            }
//            dd(session()->get('cart', $cart));
            session()->put('cart', $cart);
            return session()->get('cart');
//        return $request['product_id'];
    }
    public function findAll()
    {
//        dd(session()->get('cart'));
         return session()->get('cart');

    }
}
