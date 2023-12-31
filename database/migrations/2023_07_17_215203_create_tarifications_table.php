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
        Schema::create('tarifications', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable(); //Frais scolaire // Réinscription
            $table->double("prix");
            $table->foreignId("categoriestarification_id")->constrained();
            $table->foreignId("anneesscolaire_id")->constrained();
            $table->foreignId("classe_id")->constrained();
            $table->boolean("statut")->default(1);
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
        Schema::dropIfExists('tarifications');
    }
};
