<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdmissionIdToCaissesTable extends Migration
{
    public function up()
    {
        Schema::table('caisses', function (Blueprint $table) {
            $table->unsignedBigInteger('admission_id')->nullable();

            // Si vous souhaitez ajouter une clé étrangère vers la table d'admissions
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('caisses', function (Blueprint $table) {
            $table->dropColumn('admission_id');
            // Si vous avez ajouté une clé étrangère, supprimez-la également ici
        });
    }
}
