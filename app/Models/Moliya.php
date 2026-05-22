<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moliya extends Model{
    use HasFactory;

    protected $fillable = [
        'cash',
        'card',
        'bank',
        'contaner',
        'cover',
        'label',
        'price_contaner',
        'price_water',
    ];

    protected function casts(): array{
        return [
            'cash' => 'decimal:2',
            'card' => 'decimal:2',
            'bank' => 'decimal:2',
            'contaner' => 'decimal:0',
            'cover' => 'decimal:0',
            'label' => 'decimal:0',
            'price_contaner' => 'decimal:0',
            'price_water' => 'decimal:0',
        ];
    }

    public static function getMoliya(){
        return self::firstOrCreate(
            ['id' => 1],
            [
                'cash'           => 0,
                'card'           => 0,
                'bank'           => 0,
                'contaner'       => 0,
                'cover'          => 0,
                'label'          => 0,
                'price_contaner' => 0,
                'price_water'    => 0,
            ]
        );
    }
}
