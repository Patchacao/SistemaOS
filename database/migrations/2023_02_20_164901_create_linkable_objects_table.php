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
        Schema::create('linkable_objects', function (Blueprint $table) {
            $table->id();
            $table->string('linkable_object')->unique();
            $table->timestamps();
        });

        Schema::create('item_linkable_object', function (Blueprint $table) {
            $table->id();
            $table->foreignId('linkable_object_id')->constrained('linkable_objects');
            $table->foreignId('item_id')->constrained('items');
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
        
        Schema::dropIfExists('item_linkable_object');
        Schema::dropIfExists('linkable_objects');
    }
};
