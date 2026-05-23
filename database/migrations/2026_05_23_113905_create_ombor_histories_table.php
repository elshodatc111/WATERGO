<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('ombor_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('contaner');
            $table->integer('label');
            $table->integer('cover');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('ombor_histories');
    }
};
