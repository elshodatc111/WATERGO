<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder{

    public function run(): void{
        User::create([
            'name' => 'Asosiy Admin',
            'phone' => '+998901234567',
            'password' => 'password',
            'type' => 'admin',
            'status' => true,
            'balans' => 0.00,
        ]);
        User::create([
            'name' => 'Loyiha Direktori',
            'phone' => '+998901112233',
            'password' => 'password',
            'type' => 'drektor',
            'status' => true,
            'balans' => 500000.00,
        ]);
        User::create([
            'name' => 'Malika Operator',
            'phone' => '+998904445566',
            'password' => 'password',
            'type' => 'operator',
            'status' => true,
            'balans' => 0.00,
        ]);
        User::create([
            'name' => 'Eshmat Kuryer',
            'phone' => '+998907778899',
            'password' => 'password',
            'type' => 'currer',
            'status' => true,
            'balans' => 25000.50,
        ]);
        User::create([
            'name' => 'Toshmat Omborchi',
            'phone' => '+998909990011',
            'password' => 'password',
            'type' => 'omborchi',
            'status' => true,
            'balans' => 0.00,
        ]);
        User::create([
            'name' => 'Bloklangan Operator',
            'phone' => '+998905555555',
            'password' => 'password',
            'type' => 'operator',
            'status' => true,
            'balans' => 0.00,
        ]);
    }
}
