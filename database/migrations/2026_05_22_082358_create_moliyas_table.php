<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('moliyas', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash', 15, 2);
            $table->decimal('card', 15, 2);
            $table->decimal('bank', 15, 2);
            $table->decimal('contaner', 15, 0);
            $table->decimal('cover', 15, 0);
            $table->decimal('label', 15, 0);
            $table->decimal('price_contaner', 15, 0);
            $table->decimal('price_water', 15, 0);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('moliyas');
    }
};
