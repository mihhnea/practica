<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoardPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_page', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('assignment');
            $table->enum('status', [
                1 => 'created',
                2 => 'inprogress',
                3 => 'done'
            ]);
            $table->date('dateofcreation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_page');
    }
}
