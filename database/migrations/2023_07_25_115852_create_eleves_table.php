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
            $table->string('telephone1')->nullable();
            $table->dateTime('dateNaissance');
            $table->string('lieuNaissance')->nullable();
            $table->string('email')->nullable();
            $table->text('description')->nullable();
            $table->foreignId("classe_id")->constrained();
            $table->foreignId("anneesscolaire_id")->constrained();
            $table->foreignId("parent_id")->constrained();

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
