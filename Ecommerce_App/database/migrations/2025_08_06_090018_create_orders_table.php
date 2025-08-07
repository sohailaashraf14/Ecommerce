<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
Schema::create('orders', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('paymob_order_id')->nullable();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->unsignedBigInteger('amount_cents');
$table->boolean('is_paid')->default(false);
$table->timestamps();
});
}

public function down(): void
{
Schema::dropIfExists('orders');
}
};
