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
        Schema::create('anneesscolaires', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->timestamp('dateDebut')->nullable();
            $table->timestamp('dateFin')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('annees_scolaires');
    }
};
