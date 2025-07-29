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
        Schema::create('organization_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('unit_name');
            $table->string('position_title')->nullable();
            $table->string('person_name')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('order_position')->default(0);
            $table->timestamps();
            
            $table->foreign('parent_id')->references('id')->on('organization_structures')->onDelete('set null');
            $table->index(['parent_id', 'order_position']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_structures');
    }
};
