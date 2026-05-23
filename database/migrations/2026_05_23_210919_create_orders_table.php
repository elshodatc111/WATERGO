<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained('regions');
            $table->foreignId('currer_id')->nullable();
            $table->string('phone');
            $table->string('address');
            $table->decimal('order_count',10,0);
            $table->decimal('cash',10,2);
            $table->decimal('card',10,2);
            $table->decimal('bank',10,2);
            $table->decimal('full_contaner',10,0);
            $table->decimal('empty_contaner',10,0);
            $table->enum('status',['new','pending','success','cancel']);
            $table->string('description')->nullable();
            $table->foreignId('operator_id')->constrained('users');
            $table->timestamps();

            // MariaDB CASE operatori bilan funksional indeks yaratishda xatolik beradi.
            // Buni virtual ustun (Virtual Column) yordamida hal qilamiz.
            // Bu bitta raqamdan faqat bitta 'new' va bitta 'pending' buyurtma bo'lishini ta'minlaydi.
            $table->string('active_order_check')
                ->virtualAs("CASE WHEN status IN ('new', 'pending') THEN CONCAT(phone, '-', status) ELSE NULL END")
                ->nullable();
            $table->unique('active_order_check', 'unique_active_orders_phone');
        });
    }
    
    public function down(): void{
        Schema::dropIfExists('orders');
    }
};
