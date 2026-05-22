<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary extends Model{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description',
        'admin_id',
    ];
    protected $casts = [
        'amount' => 'decimal:2',
    ];
    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_id');
    }
}
