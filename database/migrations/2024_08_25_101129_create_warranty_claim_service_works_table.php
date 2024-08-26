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
        Schema::create('warranty_claim_service_works', function (Blueprint $table) {
            $table->id();

            $table->string('code_1c')->nullable();
            $table->string('warranty_claims_number_1c')->nullable();
            $table->foreign('warranty_claims_number_1c')->references('number_1c')->on('warranty_claims');
            $table->string('line_number')->nullable();
            $table->string('articul')->nullable();
            $table->string('product')->nullable();
            $table->decimal('qty', 10, 2)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('sum', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_claim_service_works');
    }
};
