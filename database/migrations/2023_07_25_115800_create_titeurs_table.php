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
        Schema::create('titeurs', function (Blueprint $table) {
            $table->id();
            $table->char('sexe');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone1');
            $table->string('telephone2')->nullable();
            $table->timestamp('dateNaissance')->nullable();
            $table->string('lieuNaissance')->nullable();
            $table->string('email')->nullable();
            $table->string('profession')->nullable();
            $table->string('adresse')->nullable();
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
        Schema::dropIfExists('titeurs');
    }
};
