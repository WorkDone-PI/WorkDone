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
    Schema::table('categories', function (Blueprint $table) {
        $table->dropColumn('Id_Projeto');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    // Verifica se a coluna não existe antes de tentar adicioná-la
    if (!Schema::hasColumn('categories', 'Id_Projeto')) {
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('Id_Projeto')->nullable(); // Adicione conforme necessário
        });
    }
}

};
