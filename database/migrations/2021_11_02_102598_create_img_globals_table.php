<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateImgGlobalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('img_globals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('img_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('img_globals')->insert(
            array(
                'id' => '1',
                'name' => 'Logo',
                'img_name' => ''
            )
        );
        DB::table('img_globals')->insert(
            array(
                'id' => '2',
                'name' => 'Visuel Accueil',
                'img_name' => ''
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
        Schema::dropIfExists('img_globals');
    }
}
