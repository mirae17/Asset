<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateValueColumnInAssetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->decimal('value', 15, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('asset', function (Blueprint $table) {
            $table->decimal('value', 15, 2)->change();
        });
    }
}
