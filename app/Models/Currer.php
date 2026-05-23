<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Currer extends Model{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'cash',
        'card',
        'bank',
        'full_contaner',
        'empty_contaner'
    ];

    protected function casts(): array{
        return [
            'cash' => 'decimal:2',
            'card' => 'decimal:2',
            'bank' => 'decimal:2',
            'full_contaner' => 'decimal:0',
            'empty_contaner' => 'decimal:0',
        ];
    }
        
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
