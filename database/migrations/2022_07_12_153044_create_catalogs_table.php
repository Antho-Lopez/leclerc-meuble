<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('img_name')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('is_on_home');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('catalogs')->insert(
            array(
                'id' => '1',
                'name' => '',
                'img_name' => '',
                'link' => '',
                'is_on_home' => 1,
            )
        );

        DB::table('catalogs')->insert(
            array(
                'id' => '2',
                'name' => '',
                'img_name' => '',
                'link' => '',
                'is_on_home' => 1,
            )
        );

        DB::table('catalogs')->insert(
            array(
                'id' => '3',
                'name' => '',
                'img_name' => '',
                'link' => '',
                'is_on_home' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
