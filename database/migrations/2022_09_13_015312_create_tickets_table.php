<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('description');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('categories_id')->constrained();
            $table->foreignId('priority_levels_id')->constrained();
            $table->foreignId('developer_id','user_id')->references('id')->on('users');
            $table->foreignId('statuses_id')->constrained();
            $table->string('developer_notes')->default('none');
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
        Schema::dropIfExists('tickets');
    }
}
