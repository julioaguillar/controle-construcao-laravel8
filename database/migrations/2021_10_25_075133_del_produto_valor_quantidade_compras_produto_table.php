<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DelProdutoValorQuantidadeComprasProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::dropIfExists('compras_produto');
        Schema::create('compras_produto', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('fornecedor_id')->nullable()->constrained('fornecedores');
            $table->foreignId('forma_pagamento_id')->nullable()->constrained('formas_pagamento');
            $table->string('pdf', 10000)->nullable();
            $table->string('nome_pdf', 300)->nullable();
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
        Schema::table('compras_produto', function (Blueprint $table) {
            $table->foreignId('produto_id')->after('data')->constrained('produtos');
            $table->decimal('valor', $precision = 14, $scale = 2)->after('forma_pagamento_id');
            $table->decimal('quantidade', $precision = 14, $scale = 2)->after('valor');
        });
    }
}
