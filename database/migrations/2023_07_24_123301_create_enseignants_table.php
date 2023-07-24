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
        Schema::create('enseignants', function (Blueprint $table) {
            $table->id();
            $table->char('sexe');
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone1');
            $table->string('telephone2')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('dateContrat')->nullable();
            $table->char('typeContrat')->nullable();
            $table->integer('duree')->nullable();
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
        Schema::dropIfExists('enseignants');
    }
};
