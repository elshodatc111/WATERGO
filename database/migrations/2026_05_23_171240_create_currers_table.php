<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        Schema::create('currers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('cash', 15, 2)->default(0);
            $table->decimal('card', 15, 2)->default(0);
            $table->decimal('bank', 15, 2)->default(0);
            $table->decimal('full_contaner', 15, 0)->default(0);
            $table->decimal('empty_contaner', 15, 0)->default(0);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('currers');
    }
};
