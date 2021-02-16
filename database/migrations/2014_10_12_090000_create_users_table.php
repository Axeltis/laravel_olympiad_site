<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('status_id');
            $table->foreign('status_id')->references('id')->on('user_statuses');
            $table->index('status_id');

            $table->uuid('role_id');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->index('role_id');

            $table->string('name',16);
            $table->string('middlename',16);
            $table->string('surname',16);
            $table->string('phone',16)->unique();
            $table->string('email',50)->unique();
            $table->date('birth_date');
            $table->string('password',80);
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
