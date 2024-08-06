<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\Transaction\StoreTransactionRequest;
use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\TransactionRepository;
use App\Utils\ApiResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected readonly TransactionRepository $transaction,
        protected readonly TransactionItem $transactionItem
    )
    {}

    public function index() {
        $transactions = $this->transaction->findAll();
        return ApiResponse::success([
            'Transaction' => $transactions
        ], 'Fetched', 'Transaction');
    }
    public function show($id) {
        $transaction = $this->transaction->getTransactionDetail($id);
        return ApiResponse::success([
            'Transaction' => $transaction
        ], 'Fetched', 'Transaction');
    }

    public function store(StoreTransactionRequest $request)
    {
        try {
            $transaction = $this->transaction->store($request->validated());
            return ApiResponse::success([$transaction], 'Create', 'Transaction');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), 'Create', 'Transaction');
        }
    }
}
