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
        Schema::create('niveauxscolaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); //Primaire : Secondaire
            $table->integer('ordre')->nullable();
            $table->boolean("statut")->default(1);
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
        Schema::dropIfExists('niveaux_scolaires');
    }
};
