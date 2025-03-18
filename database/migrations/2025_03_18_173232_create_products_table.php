<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('tax_class_id')->nullable();
            $table->string('slug', 191)->unique();
            $table->decimal('price', 18, 4);
            $table->decimal('special_price', 18, 4)->nullable();
            $table->string('special_price_type', 191)->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4);
            $table->string('sku', 191)->unique();
            $table->boolean('manage_stock')->default(0);
            $table->integer('qty')->nullable();
            $table->boolean('in_stock')->default(1);
            $table->integer('viewed')->default(0);
            $table->boolean('is_active')->default(1);
            $table->datetime('new_from')->nullable();
            $table->datetime('new_to')->nullable();
            $table->integer('position')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
