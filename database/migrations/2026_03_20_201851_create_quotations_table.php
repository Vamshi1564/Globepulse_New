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
        Schema::create('quotations', function (Blueprint $table) {
    $table->id();

    $table->foreignId('rfq_id')->constrained()->cascadeOnDelete();

    $table->unsignedBigInteger('supplier_id');
    $table->unsignedBigInteger('buyer_id');

    $table->string('price');
    $table->string('delivery_time')->nullable();
    $table->string('payment_terms')->nullable();
    $table->text('message')->nullable();

    $table->tinyInteger('status')->default(0); 
    // 0 = pending, 1 = accepted, 2 = rejected

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
