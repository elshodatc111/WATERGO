<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('ombors', function (Blueprint $table) {
            $table->id();
            $table->decimal('cash', 15, 2);
            $table->decimal('card', 15, 2);
            $table->decimal('bank', 15, 2);
            $table->decimal('full_contaner', 15, 0);
            $table->decimal('full_label', 15, 0);
            $table->decimal('full_cover', 15, 0);
            $table->decimal('empty_contaner', 15, 0);
            $table->decimal('defect_contaner', 15, 0);
            $table->timestamps();
        });
    }
    public function down(): void{
        Schema::dropIfExists('ombors');
    }
};
