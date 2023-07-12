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
        Schema::create('user_module', function (Blueprint $table) {
            $table->foreignId("user_id")->constrained();
            $table->foreignId("module_id")->constrained();
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
        Schema::table('user_module', function (Blueprint $table) {
            $table->dropForeign("user_id");
            $table->dropForeign("module_id");
        });
        Schema::dropIfExists('user_module_tables');
    }
};
