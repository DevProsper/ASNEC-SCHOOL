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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("eleve_id")->constrained();
            $table->foreignId("tarification_id")->constrained();
            $table->foreignId("classe_id")->constrained();
            $table->foreignId("anneesscolaire_id")->constrained();
            $table->char("statutAdmission"); //1-Nouveau, 2-Redoublant
            $table->timestamps();
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
        Schema::dropIfExists('admissions');
    }
};
