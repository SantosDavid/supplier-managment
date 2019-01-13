<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('addresstable_id')->unsigned();
            $table->string('addresstable_type');
            $table->string('street');
            $table->integer('number')->nullable()->unsigned();
            $table->string('neighborhood');
            $table->string('city');
            $table->string('zipcode');
            $table->enum('type', ['thirst', 'subsidiary']);
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
        Schema::dropIfExists('addresses');
    }
}
