<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table){
            $table->string('name');
            $table->string('slug');
            $table->string('sku')->unique();
            $table->string('brand')->default('SOFA PHU THINH');
            $table->string('image');
            $table->string('descripton')->nullable();
            $table->text('long_description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('collection')->unsigned()->nullable();
            $table->string('width')->nullable();
            $table->string('long')->nullable();
            $table->string('deep')->nullable();
            $table->string('weight')->nullable();
            $table->integer('room')->unsigned()->nullable();
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
        Schema::dropIfExists('products');
    }
}
