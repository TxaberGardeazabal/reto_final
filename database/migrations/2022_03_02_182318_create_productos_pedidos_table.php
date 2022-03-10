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
        Schema::create('productos_pedidos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('pedido_id');
            $table->integer('cantidad');

            $table->foreign('producto_id')->nullable()->references('id')->on('productos')->nullOnDelete();
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_pedidos');
    }
};
