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
        Schema::table('orders', function (Blueprint $table) {
            if (! Schema::hasColumn('orders', 'total_amount')) {
                $table->decimal('total_amount', 12, 2)->default(0.00)->after('amount');
            }
            if (! Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('payment_status');
            }
            if (! Schema::hasColumn('orders', 'snap_token')) {
                $table->string('snap_token')->nullable()->after('payment_method');
            }
            if (! Schema::hasColumn('orders', 'metadata')) {
                $table->json('metadata')->nullable()->after('snap_token');
            }
        });

        if (! Schema::hasTable('order_items')) {
            Schema::create('order_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
                $table->string('item_type'); // theme, package, addon
                $table->unsignedBigInteger('item_id');
                $table->string('item_name');
                $table->decimal('price', 12, 2)->default(0.00);
                $table->unsignedInteger('quantity')->default(1);
                $table->decimal('subtotal', 12, 2)->default(0.00);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
                $table->string('payment_code')->unique();
                $table->decimal('amount', 12, 2);
                $table->string('method')->default('midtrans');
                $table->string('status')->default('pending'); // pending, paid, failed, expired
                $table->json('payload')->nullable();
                $table->timestamp('paid_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_items');

        Schema::table('orders', function (Blueprint $table) {
            $dropCols = [];
            foreach (['total_amount', 'status', 'snap_token', 'metadata'] as $col) {
                if (Schema::hasColumn('orders', $col)) {
                    $dropCols[] = $col;
                }
            }
            if (! empty($dropCols)) {
                $table->dropColumn($dropCols);
            }
        });
    }
};
