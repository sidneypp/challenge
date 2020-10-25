<?php

namespace App\Http\Controllers;

use App\Enumerators\TransactionPermission;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $service)
    {
        $this->transactionService = $service;
    }

    public function index()
    {
        $this->authorize(TransactionPermission::TRANSACTION_VIEW_ANY);
        $transactions = $this->transactionService->getAll();
        return response($transactions);
    }

    public function show(int $id)
    {
        $this->authorize(TransactionPermission::TRANSACTION_VIEW);
        $transaction = $this->transactionService->findOrFail($id);
        return response($transaction);
    }

    public function store(Request $request)
    {
        $this->authorize(TransactionPermission::TRANSACTION_CREATE);
        $validatedData = $this->validate($request, [
            'value' => 'required|numeric',
            'payer' => 'required|int|different:payee|exists:wallets,id,deleted_at,NULL',
            'payee' => 'required|int|different:payer|exists:wallets,id,deleted_at,NULL'
        ]);
        $user = auth()->user();
        $transaction = $transaction = $this->transactionService->save($validatedData, $user);
        return response($transaction, Response::HTTP_CREATED);
    }
}
