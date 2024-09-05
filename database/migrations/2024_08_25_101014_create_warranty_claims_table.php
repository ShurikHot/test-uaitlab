<?php

use App\Enums\StatusEnums;
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
        Schema::create('warranty_claims', function (Blueprint $table) {
            $table->id();

            $table->string('code_1c')->unique();
            $table->string('number_1c')->unique();
            $table->dateTime('date')->nullable();
            $table->dateTime('date_of_claim')->nullable();
            $table->dateTime('date_of_sale')->nullable();
            $table->string('factory_number')->nullable();
            $table->string('comment')->nullable();
            $table->string('point_of_sale')->nullable();
            $table->string('product_name')->nullable();
            $table->text('details')->nullable();
            $table->string('manager')->nullable();
            $table->string('autor')->nullable();
            $table->string('client_name')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('client_phone')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('type_of_claim')->nullable();
            $table->string('receipt_number')->nullable();
            $table->string('service_partner')->nullable();
            $table->string('service_contract')->nullable();
            $table->string('product_article')->nullable();
            $table->string('photo_path')->nullable();
            $table->enum('status', StatusEnums::getStatuses())
                ->default(StatusEnums::FALSE->value)
                ->nullable();
            $table->decimal('spare_parts_sum', 10, 2)->nullable();
            $table->decimal('service_works_sum', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warranty_claims');
    }
};
