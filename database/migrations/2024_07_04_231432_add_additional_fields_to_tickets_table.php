<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('nombre_completo')->after('celular')->nullable();
            $table->string('numero_identificacion')->after('nombre_completo')->nullable();
            $table->string('codigo_unico')->after('numero_identificacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('nombre_completo');
            $table->dropColumn('numero_identificacion');
            $table->dropColumn('codigo_unico');
        });
    }
}
