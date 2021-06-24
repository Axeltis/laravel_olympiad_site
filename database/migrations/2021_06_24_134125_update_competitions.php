<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCompetitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('competitions', function (Blueprint $table) {
  
            $table->string('preview_text','60000')->change();
            $table->string('description','60000')->change();
            $table->string('teaching_materials','60000')->change();
                   
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('competitions', function (Blueprint $table) {
            $table->string('preview_text','18000')->change();
            $table->string('description','18000')->change();
            $table->string('teaching_materials','18000')->change();
	  });
    }
}
