<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmHistory extends Model{
    
    use HasFactory;

    protected $fillable = [
        'type',
        'status',
        'count',
        'description',
        'user_id',
        'admin_id',
    ];
    
    protected function casts(): array{
        return [
            'status' => 'boolean',
            'count'  => 'decimal:0',
        ];
    }
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
