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
        Schema::create('object_orders', function (Blueprint $table) {
            $table->id();
            $table->string('Object_Number')->unique();
            $table->foreignId('service_orders_id')->constrained('service_orders');
            $table->string('status');
            $table->string('last_status');
            $table->string('created_by');
            $table->text('details');
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
        Schema::dropIfExists('object_orders');
    }
};
