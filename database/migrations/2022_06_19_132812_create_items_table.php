<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string(     'name');
            $table->integer(    'price');
            $table->string(     'image')->nullable();
            $table->string(     'model_year');
            $table->string(     'model_type');
            $table->integer(   'available')->default(0);
            $table->foreignId(  'category_id')
                ->constrained(      'categories')
                ->onUpdate(     'cascade')
                ->onDelete(     'cascade');
            $table->timestamps();
            $table->string(     'model_country');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
