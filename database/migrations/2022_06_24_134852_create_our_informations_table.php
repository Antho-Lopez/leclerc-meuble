<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOurInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_informations', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('address');
            $table->integer('cp');
            $table->string('city');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('our_informations')->insert(
            array(
                'id' => '1',
                'email' => 'email@email.fr',
                'phone' => '0000000000',
                'address' => '9, rue .....',
                'cp' => '00000',
                'city' => 'votre ville',
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
        Schema::dropIfExists('our_informations');
    }
}
