<?php

namespace Tests\Feature;

use App\Enumerators\TransactionPermission;
use App\Exceptions\AuthorizationExceptions;
use App\Jobs\SendNotificationJob;
use App\Models\Transaction;
use App\Services\AuthorizationService;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Mockery;
use Tests\Helpers\AuthHelper;
use Tests\Helpers\UserBuilder;
use Tests\TestCase;

class TransactionFeatureTest extends TestCase
{
    use AuthHelper, DatabaseMigrations;

    const TRANSACTION_END_POINT = 'transaction';

    public function testShouldReturn200WhenListingTransactions()
    {
        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_VIEW_ANY)
            ->build();
        $response = $this->actingAs($user)->get(self::TRANSACTION_END_POINT);

        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn200WhenShowingATransaction()
    {
        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_VIEW)
            ->build();
        $transaction = Transaction::factory()->create();
        $response = $this->actingAs($user)->get(self::TRANSACTION_END_POINT . "/$transaction->id");

        $response->assertResponseStatus(Response::HTTP_OK);
    }

    public function testShouldReturn401WhenWalletDoesNotBelongToLoggedUser()
    {
        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_CREATE)
            ->build();
        $transaction = Transaction::factory()->raw();
        $response = $this->actingAs($user)->post(self::TRANSACTION_END_POINT, $transaction);

        $response->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertJson(
            $response->response->getContent(),
            trans('exception.wallet_does_not_belong_to_logged_user')
        );
    }

    public function testShouldReturn401WhenValueGreaterThanAvailableValueInWallet()
    {
        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_CREATE)
            ->build();
        $userWallet = $user->wallets->first();
        $walletValue = $userWallet->value;
        $transaction = Transaction::factory(['payer' => $userWallet, 'value' => $walletValue + 1])->raw();
        $response = $this->actingAs($user)->post(self::TRANSACTION_END_POINT, $transaction);

        $response->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
        $this->assertJson(
            $response->response->getContent(),
            trans('exception.value_greater_than_available_value_in_wallet')
        );
    }

    public function testShouldReturn201WhenCreatingATransaction()
    {
        app()->bind(AuthorizationService::class, function () {
            $authorizationRepositoryMock = Mockery::mock(AuthorizationService::class);
            $authorizationRepositoryMock->shouldReceive('isAuthorized')
                ->withAnyArgs()->andReturn(true);
            return $authorizationRepositoryMock;
        });

        $this->expectsJobs(SendNotificationJob::class);
        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_CREATE)
            ->build();
        $userWallet = $user->wallets->first();
        $walletValue = $userWallet->value;
        $transaction = Transaction::factory(['payer' => $userWallet, 'value' => $walletValue])->raw();
        $response = $this->actingAs($user)->post(self::TRANSACTION_END_POINT, $transaction);
        $response->assertResponseStatus(Response::HTTP_CREATED);
    }

    public function testShouldReturn401WhenAuthorizationServiceIsUnavailable()
    {
        app()->bind(AuthorizationService::class, function () {
            $authorizationRepositoryMock = Mockery::mock(AuthorizationService::class);
            $authorizationRepositoryMock->shouldReceive('isAuthorized')
                ->withAnyArgs()
                ->andThrowExceptions([AuthorizationExceptions::unavailable('Unavailable service')]);
            return $authorizationRepositoryMock;
        });

        $user = UserBuilder::make()
            ->withPermission(TransactionPermission::TRANSACTION_CREATE)
            ->build();
        $userWallet = $user->wallets->first();
        $walletValue = $userWallet->value;
        $transaction = Transaction::factory(['payer' => $userWallet, 'value' => $walletValue])->raw();
        $response = $this->actingAs($user)->post(self::TRANSACTION_END_POINT, $transaction);
        $response->assertResponseStatus(Response::HTTP_UNAUTHORIZED);
    }
}
