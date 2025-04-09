<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->decimal('latitude', 8, 6)->nullable()->change();
            $table->decimal('longitude', 9, 6)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('asset', function (Blueprint $table) {
            // Revert changes if necessary
            $table->decimal('latitude', 10, 0)->nullable()->change();
            $table->decimal('longitude', 10, 0)->nullable()->change();
        });
    }
};
