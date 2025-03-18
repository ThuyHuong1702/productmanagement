<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('variation_id')->constrained('variations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['product_id', 'variation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
};
