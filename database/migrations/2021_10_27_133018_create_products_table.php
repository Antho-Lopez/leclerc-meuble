<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained();
            $table->text('description')->nullable();
            $table->text('details')->nullable();
            $table->integer('price')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->string('production')->nullable();
            $table->string('img_production')->nullable();
            $table->tinyInteger('is_on_home')->nullable();
            $table->integer('nb_in_list')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
