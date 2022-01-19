<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras_produto', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('produto_id')->constrained('produtos');
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores');
            $table->foreignId('forma_pagamento_id')->nullable()->constrained('formas_pagamento');
            $table->decimal('valor', $precision = 14, $scale = 2);
            $table->string('pdf', 10000)->nullable();
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
        Schema::dropIfExists('compras_produto');
    }
}
