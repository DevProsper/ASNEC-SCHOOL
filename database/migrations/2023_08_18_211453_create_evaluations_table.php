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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("admission_id")->constrained();
            $table->foreignId("matiere_id")->constrained();
            $table->foreignId("periode_id")->constrained();
            $table->string('noteDevoir1')->nullable();
            $table->string('noteDevoir2')->nullable();
            $table->string('noteDevoir3')->nullable();
            $table->string('noteExamen')->nullable();
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
        Schema::dropIfExists('evaluations');
    }
};
