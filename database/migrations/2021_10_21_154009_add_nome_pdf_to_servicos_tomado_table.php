<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNomePdfToServicosTomadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servicos_tomado', function (Blueprint $table) {
            $table->string('nome_pdf', 300)->after('pdf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicos_tomado', function (Blueprint $table) {
            $table->dropColumn('nome_pdf');
        });
    }
}
