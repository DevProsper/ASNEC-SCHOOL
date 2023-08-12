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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("eleve_id")->constrained();
            $table->foreignId("tarification_id")->constrained();
            $table->foreignId("anneesscolaire_id")->constrained();
            $table->unsignedBigInteger('periode_id')->nullable();
            $table->double("montantVerse");
            $table->double("montantRestant");
            $table->boolean("statut"); //1-Terminé, 2-Accompte
            $table->boolean("etat"); // 1 Entrées, 2 Dépenses
            $table->unsignedBigInteger('admission_id')->nullable();
            // Si vous souhaitez ajouter une clé étrangère vers la table d'admissions
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('set null');
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('set null');
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
        Schema::dropIfExists('caisses');
    }
};
