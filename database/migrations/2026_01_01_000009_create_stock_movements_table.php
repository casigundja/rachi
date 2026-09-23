<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabela: stock_movements (entry, exit, adjustment, return, sale)
     */
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('type', ['entry', 'exit', 'adjustment', 'return', 'sale']);
            $table->integer('quantity'); // Positivo ou negativo
            $table->integer('previous_quantity');
            $table->integer('current_quantity');
            $table->string('reason')->nullable();
            $table->string('reference_type')->nullable(); // Ex: App\Models\Order
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
