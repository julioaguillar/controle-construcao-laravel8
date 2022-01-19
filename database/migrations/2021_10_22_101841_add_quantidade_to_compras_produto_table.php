<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantidadeToComprasProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras_produto', function (Blueprint $table) {
            $table->decimal('quantidade', $precision = 14, $scale = 2)->after('valor');
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
            $table->dropColumn('quantidade');
        });
    }
}
