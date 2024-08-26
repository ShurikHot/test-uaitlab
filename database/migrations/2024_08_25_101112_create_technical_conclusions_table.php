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
        Schema::create('technical_conclusions', function (Blueprint $table) {
            $table->id();

            $table->string('code_1c')->nullable();
            $table->string('number_1c')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('defect_codes_code_1c')->nullable();
            $table->string('conclusion')->nullable();
            $table->string('resolution')->nullable();
            $table->string('symptom_codes_code_1c')->nullable();
            $table->string('warranty_claims_code_1c')->nullable();
            $table->foreign('warranty_claims_code_1c')->references('code_1c')->on('warranty_claims');
            $table->string('appeal_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_conclusions');
    }
};
