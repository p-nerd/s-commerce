<?php

use App\Enums\ProductType;
use App\Models\Category;
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

            $table->foreignIdFor(Category::class);

            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->string('short_description');
            $table->enum('type', ProductType::values());
            $table->string('sku');
            $table->date('manufactured_date');
            $table->date('released_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->text('long_description')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('featured')->default(false);

            $table->timestamps();
            $table->softDeletes();
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
