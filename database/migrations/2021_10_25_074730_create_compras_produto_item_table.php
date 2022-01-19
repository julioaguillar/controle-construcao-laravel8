<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasProdutoItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_produto_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compras_produto_id')->constrained('compras_produto')->onDelete('cascade');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->decimal('valor', $precision = 14, $scale = 2);
            $table->decimal('quantidade', $precision = 14, $scale = 2);
            $table->decimal('total', $precision = 14, $scale = 2);
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
        Schema::dropIfExists('compras_produto_item');
    }
}
