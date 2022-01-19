<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTomadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos_tomado', function (Blueprint $table) {
            $table->id();
            $table->date('data');
            $table->foreignId('servico_id')->constrained('servicos');
            $table->foreignId('prestador_servico_id')->nullable()->constrained('prestadores_servico');
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
        Schema::dropIfExists('servicos_tomado');
    }
}
