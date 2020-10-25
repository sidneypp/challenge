<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payer');
            $table->unsignedBigInteger('payee');
            $table->decimal('value', 16);
            $table->timestamps();

            $table->foreign('payer')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payee')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
