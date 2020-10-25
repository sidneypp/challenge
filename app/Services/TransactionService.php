<?php

namespace App\Services;

use App\Exceptions\TransactionExceptions;
use App\Jobs\SendNotificationJob;
use App\Models\Transaction;
use App\Models\User;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    private $repository;

    private $walletService;

    private $authorizationService;


    public function __construct(
        TransactionRepository $repository,
        WalletService $walletService,
        AuthorizationService $authorizationService
    ) {
        $this->repository = $repository;
        $this->walletService = $walletService;
        $this->authorizationService = $authorizationService;
    }

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function findOrFail(int $id): Transaction
    {
        return $this->repository->findOrFail($id);
    }

    public function save(array $attributes, User $user): Transaction
    {
        $transaction = $this->repository->create($attributes);
        $payerWallet = $this->walletService->findOrFail($transaction->payer);
        $payeeWallet = $this->walletService->findOrFail($transaction->payee);

        if ($payerWallet->user->id !== $user->id) {
            throw TransactionExceptions::walletDoesNotBelongToLoggedUser();
        }

        if ($transaction->value > $payerWallet->value) {
            throw TransactionExceptions::valueGreaterThanAvailableValueInWallet();
        }

        DB::transaction(function () use ($transaction, $payerWallet, $payeeWallet) {
            $payerWalletValue = $payerWallet->value - $transaction->value;
            $this->walletService->update($payerWallet, ['value' => $payerWalletValue]);

            $payeeWalletValue = $payeeWallet->value + $transaction->value;
            $this->walletService->update($payeeWallet, ['value' => $payeeWalletValue]);

            if ($this->authorizationService->isAuthorized()) {
                $this->repository->save($transaction);
            }
        });

        dispatch(new SendNotificationJob());

        return $transaction;
    }
}
