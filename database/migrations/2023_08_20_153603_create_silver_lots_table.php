<?php

use App\StalkerPay\Lot\Enum\StatusEnum;
use App\StalkerPay\Lot\Silver\Enum\TypeEnum;
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
        Schema::create('silver_lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('minimum');
            $table->decimal('price');
            $table->text('description')->nullable();
            $table->enum('type', array_column(TypeEnum::cases(), 'value'));
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->unsignedBigInteger('server_id');
            $table->foreign('server_id')->references('id')->on('servers');
            $table->enum('status', array_column(StatusEnum::cases(), 'value'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('silver_lots');
    }
};
