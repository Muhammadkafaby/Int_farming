<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('farming_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mitra_id')->constrained('mitras')->onDelete('cascade');
            $table->string('item_type');
            $table->string('item_name');
            $table->text('description'); 
            $table->integer('stock')->default(0);
            $table->decimal('price', 10, 2)->default(0.00);
            $table->string('photo', 300)->nullable();
            $table->integer('sold')->default(0);
            $table->integer('discount');
            $table->decimal('rating', 2, 1)->default(rand(35, 46) / 10);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('farming_needs');
    }
};
