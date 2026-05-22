<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{
        Schema::create('farm_histories', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'input_label', 
                'input_cover', 
                'input_contaner',
                'input_bank', 
                'input_card', 
                'input_cash',
                'income_bank', 
                'income_card', 
                'income_cash',
                'cost_bank', 
                'cost_card', 
                'cost_cash',
                'salary_cash', 
                'salary_card', 
                'salary_bank', 
                'output_contaner', 
                'output_cover', 
                'output_label',
            ]);
            $table->boolean('status')->default(false);
            $table->decimal('count', 10, 0)->default(0);
            $table->string('description')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('farm_histories');
    }
};
