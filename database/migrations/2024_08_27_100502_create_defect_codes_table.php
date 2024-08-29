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
        Schema::create('defect_codes', function (Blueprint $table) {
            $table->id();

            $table->string('code_1C');
            $table->string('name');
            $table->string('parent_id', 40)->nullable();
            $table->tinyInteger('is_folder')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->dateTime('created')->nullable();
            $table->dateTime('edited')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defect_codes');
    }
};
