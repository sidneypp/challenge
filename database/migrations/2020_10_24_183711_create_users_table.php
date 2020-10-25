<?php

use App\Enumerators\UserTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cpf')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->decimal('wallet')->default(0);
            $table->unsignedBigInteger('role_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
