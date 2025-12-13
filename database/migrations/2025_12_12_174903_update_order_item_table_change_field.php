<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('order_items', function (Blueprint $table) {

        $table->dropColumn('product_id');
    });

    Schema::table('order_items', function (Blueprint $table) {

        $table->foreignId('product_id')
              ->constrained('products')
              ->onDelete('cascade')
              ->after('order_id');
    });
}

public function down(): void
{
    Schema::table('order_items', function (Blueprint $table) {
        // Rollback
        $table->dropForeign(['product_id']);
        $table->dropColumn('product_id');


        $table->unsignedBigInteger('product_id')->after('order_id');
    });
}


};
