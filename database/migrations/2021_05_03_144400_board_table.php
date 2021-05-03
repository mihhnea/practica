<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BoardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {


        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user');
            $table->integer('members');
            $table->enum('actions', [
                1 => 'edit',
                2 => 'delete'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
}
