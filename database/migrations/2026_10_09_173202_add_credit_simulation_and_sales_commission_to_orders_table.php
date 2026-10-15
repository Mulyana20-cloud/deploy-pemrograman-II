<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'credit_simulation')) {
                $table->boolean('credit_simulation')
                    ->default(false);
            }

            if (!Schema::hasColumn('orders', 'installment_months')) {
                $table->unsignedSmallInteger('installment_months')
                    ->nullable();
            }

            if (!Schema::hasColumn('orders', 'installment_amount')) {
                $table->decimal('installment_amount', 12, 2)
                    ->nullable();
            }

            if (!Schema::hasColumn('orders', 'sales_commission')) {
                $table->decimal('sales_commission', 12, 2)
                    ->default(0);
            }

            if (!Schema::hasColumn('orders', 'commission_status')) {
                $table->string('commission_status', 30)
                    ->default('pending');
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = [
                'credit_simulation',
                'installment_months',
                'installment_amount',
                'sales_commission',
                'commission_status',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
