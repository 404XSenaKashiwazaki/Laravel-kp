<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('payment', function (Blueprint $table) {
    $table->uuid('uuid')->primary();

    $table->foreignId('order_id')
        ->constrained()
        ->cascadeOnDelete();

    // ✅ BUAT KOLOM DULU
    $table->uuid('bank_id')->nullable();

    // ✅ BARU BUAT FOREIGN KEY
    $table->foreign('bank_id', 'fk_payment_bank_uuid')
        ->references('uuid')
        ->on('bank')
        ->cascadeOnUpdate()
        ->nullOnDelete();

    $table->bigInteger('total');
    $table->string('gambar');
    $table->text('note')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('payment');
    }
};
