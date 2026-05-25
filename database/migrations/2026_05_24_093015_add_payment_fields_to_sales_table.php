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
    Schema::table('sales', function (Blueprint $table) {

        $table->decimal('amount_paid', 12, 2)
            ->default(0);

        $table->decimal('balance', 12, 2)
            ->default(0);

        $table->string('payment_status')
            ->default('Paid');

    });
}

public function down(): void
{
    Schema::table('sales', function (Blueprint $table) {

        $table->dropColumn([
            'amount_paid',
            'balance',
            'payment_status'
        ]);

    });
}
};
