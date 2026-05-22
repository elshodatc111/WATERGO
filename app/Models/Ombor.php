<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ombor extends Model{
    use HasFactory;

    protected $fillable = [
        'cash',
        'card',
        'bank',
        'full_contaner',
        'full_label',
        'full_cover',
        'empty_contaner',
        'defect_contaner',
    ];

    protected function casts(): array{
        return [
            'cash' => 'decimal:2',
            'card' => 'decimal:2',
            'bank' => 'decimal:2',
            'full_contaner' => 'decimal:0',
            'full_label' => 'decimal:0',
            'full_cover' => 'decimal:0',
            'empty_contaner' => 'decimal:0',
            'defect_contaner' => 'decimal:0',
        ];
    }

    public static function getOmbor(){ 
        return self::firstOrCreate(
            ['id' => 1],
            [
                'cash'           => 0,
                'card'           => 0,
                'bank'           => 0,
                'full_contaner'  => 0,
                'full_label'     => 0,
                'full_cover'     => 0,
                'empty_contaner' => 0,
                'defect_contaner' => 0,
            ]
        );
    }
}
