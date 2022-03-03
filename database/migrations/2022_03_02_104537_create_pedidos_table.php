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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('estado');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');

            /*
             * $table->unsignedBigInteger('producto_id');
             * $table->foreign('producto_id')->references('id')->on('productos'); 
             * $table->integer('cantidad);
             */

            // https://medium.com/@afrazahmad090/laravel-many-to-many-relationship-explained-822b554c1973
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};
