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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->string('status')->default('available');
            $table->string('image');
            // Tambahkan kondisi sebelum menambahkan kunci asing
            if (Schema::hasTable('categories')) {
                $table->foreignId('category_id')->constrained();
            } else {
                $table->unsignedBigInteger('category_id');
            }
            if (Schema::hasTable('users')) {
                $table->foreignId('user_id')->constrained();
            } else {
                $table->unsignedBigInteger('user_id');
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
