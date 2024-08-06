<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function __construct(
        protected readonly Transaction $transaction,
        protected readonly TransactionItem $transactionItem,
        protected readonly Product $product
    ){}

    public function findAll()
    {
        return $this->transaction->latest()->get();
    }

    public function findById(int $id): Transaction {
        return $this->transaction->where('id', $id)->first();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $transaction = $this->transaction->create([
                "price" => $request['total_price'],
                "total_payment" => $request['total_payment'],
                "total_exchange" => $request['total_exchange']
            ]);
            foreach ($request['products'] as $item) {
                $product = $this->product->find($item['product_id']);
                $product->decreaseStock($item['quantity']);

                $this->transactionItem->create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            DB::commit();
            return $transaction;
        } catch (QueryException $e) {
            DB::rollBack();
            throw $e; // Re-throw the exception
        }
    }

    public function getTransactionDetail($id)
    {
        $transactionData = $this->transaction->where('id', $id)->first();
        $transactionItem = $this->transactionItem->where('transaction_id', $id)->with('transactionProduct')->get();
        return [$transactionData, $transactionItem];
    }
}
