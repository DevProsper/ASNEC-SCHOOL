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
        Schema::create('eleves', function (Blueprint $table) {
            $table->id();
            $table->char('sexe');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone')->nullable();
            $table->dateTime('dateNaissance');
            $table->string('lieuNaissance')->nullable();
            $table->string('Adresse')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->foreignId("classe_id")->constrained();
            $table->string('nomTiteur');
            $table->string('prenomTiteur');
            $table->string('telephoneTiteur')->nullable();
            $table->string('emailTiteur')->nullable();
            $table->string('professionTiteur')->nullable();
            $table->string('adresseTiteur')->nullable();
            $table->boolean("statut")->default(1); // 1 pré-admission, 2 Admis
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
        Schema::dropIfExists('eleves');
    }
};
