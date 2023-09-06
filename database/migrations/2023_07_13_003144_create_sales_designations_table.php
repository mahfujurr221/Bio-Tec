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
        Schema::create('sales_designations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_default')->default(0);
            $table->integer('level')->default(0);
            $table->decimal('commission_percentage',2,1)->default(0);
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
        Schema::dropIfExists('sales_designations');
    }
};
