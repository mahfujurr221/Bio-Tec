<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_commissions', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_member_id');
            $table->integer('sales_target_id');
            $table->decimal('sale_amount',12,2);
            $table->decimal('percentage',3,2);
            $table->decimal('amount',8,2)->default(0);
            $table->integer('commission_month');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_commissions');
    }
};
