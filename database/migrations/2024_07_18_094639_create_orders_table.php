<?php

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Coupon;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Coupon::class)->nullable();
            $table->enum('status', OrderStatus::values());
            $table->string('name');
            $table->string('phone');
            $table->string('division');
            $table->string('district');
            $table->string('address');
            $table->string('landmark')->nullable();
            $table->decimal('subtotal');
            $table->decimal('discount')->nullable();
            $table->decimal('delivery')->nullable();
            $table->decimal('total');
            $table->enum('payment_method', PaymentMethod::values());
            $table->boolean('paid')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
