<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('currer_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currer_id')->constrained('users')->onDelete('cascade');
            $table->enum('type',['inp_cash','inp_card','inp_bank','inp_full_contaner','inp_empty_contaner','inp_def_contaner','out_full_contaner']);
            $table->decimal('count',10,0);
            $table->string('description');
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('currer_histories');
    }
};
