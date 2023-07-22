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
        Schema::create('matiere_classe', function (Blueprint $table) {
            $table->foreignId("matiere_id")->constrained();
            $table->foreignId("classe_id")->constrained();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matiere_classe', function (Blueprint $table) {
            $table->dropForeign("matiere_id");
            $table->dropForeign("classe_id");
        });
        Schema::dropIfExists('matiere_classe');
    }
};
