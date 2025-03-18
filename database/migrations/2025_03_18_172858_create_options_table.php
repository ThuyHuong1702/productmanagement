<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('type', 191);
            $table->boolean('is_required')->default(0);
            $table->boolean('is_global')->default(0);
            $table->integer('position')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
    }
};
