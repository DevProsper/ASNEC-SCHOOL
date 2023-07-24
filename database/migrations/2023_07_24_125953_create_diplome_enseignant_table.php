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
        Schema::create('diplome_enseignant', function (Blueprint $table) {
            $table->foreignId("diplome_id")->constrained();
            $table->foreignId("enseignant_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diplome_enseignant', function (Blueprint $table) {
            $table->dropForeign("diplome_id");
            $table->dropForeign("enseignant_id");
        });
        Schema::dropIfExists('diplome_enseignant');
    }
};
