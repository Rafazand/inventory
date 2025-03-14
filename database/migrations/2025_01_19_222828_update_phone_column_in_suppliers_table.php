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
    Schema::table('suppliers', function (Blueprint $table) {
        $table->bigInteger('phone')->change(); // Change the column type to bigInteger
    });
}

public function down()
{
    Schema::table('suppliers', function (Blueprint $table) {
        $table->string('phone')->change(); // Revert to string if needed
    });
}
};
