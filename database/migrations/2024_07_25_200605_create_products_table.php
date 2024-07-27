<?php

use App\Enums\Product\StatusEnum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->string('slug')->unique();
            $table->unsignedTinyInteger('status')->default(StatusEnum::Published->value);
            $table->unsignedInteger('min_purchase_qty')->default(1);
            $table->unsignedInteger('max_purchase_qty')->default(0);
            $table->double('price')->nullable();
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('current_stock')->default(0);
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
