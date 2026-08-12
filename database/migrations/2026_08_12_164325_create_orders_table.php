<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('dimensions')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->string('cardboard_type')->nullable();
            $table->string('printing_type')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('new');
            $table->string('tracking_code')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
