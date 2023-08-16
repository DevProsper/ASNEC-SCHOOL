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
        Schema::create('emploisdutemps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anneesscolaire_id');
            $table->unsignedBigInteger('classe_id');
            $table->string('nom');
            $table->string('heure');
            $table->unsignedBigInteger('matierej1')->nullable();
            $table->unsignedBigInteger('matierej2')->nullable();
            $table->unsignedBigInteger('matierej3')->nullable();
            $table->unsignedBigInteger('matierej4')->nullable();
            $table->unsignedBigInteger('matierej5')->nullable();
            $table->unsignedBigInteger('matierej6')->nullable();
            $table->unsignedBigInteger('matierej7')->nullable();
            $table->timestamps();

            // Clés étrangères
            $table->foreign('anneesscolaire_id')->references('id')->on('anneesscolaires');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('matierej1')->references('id')->on('matieres');
            $table->foreign('matierej2')->references('id')->on('matieres');
            $table->foreign('matierej3')->references('id')->on('matieres');
            $table->foreign('matierej4')->references('id')->on('matieres');
            $table->foreign('matierej5')->references('id')->on('matieres');
            $table->foreign('matierej6')->references('id')->on('matieres');
            $table->foreign('matierej7')->references('id')->on('matieres');
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
        Schema::dropIfExists('emploisdutemps');
    }
};
