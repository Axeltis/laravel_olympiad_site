<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_competitions', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('holding_competition_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->index('user_id');
            $table->foreign('holding_competition_id')
                ->references('id')
                ->on('holding_competitions')
                ->onDelete('cascade');
            $table->index('holding_competition_id');
            $table->boolean('file_attached')->default(false);
            $table->smallInteger('points')->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_competitions');
    }
}
