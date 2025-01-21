<?php

// database/migrations/xxxx_xx_xx_add_image_to_products_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable()->after('category_id'); // Tambahkan kolom image setelah category_id
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('image'); // Hapus kolom image jika rollback
        });
    }
}