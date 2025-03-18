<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_options', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->constrained('options')->cascadeOnDelete()->cascadeOnUpdate();
            $table->primary(['product_id', 'option_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_options');
    }
};
