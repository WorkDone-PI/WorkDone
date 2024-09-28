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
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('Id_Categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasColumn('products', 'Id_Categoria')) {
            Schema::table('products', function (Blueprint $table) {
                $table->unsignedBigInteger('Id_Categoria')->nullable(); // Adicione conforme necessário
            });
        }
    }
};
