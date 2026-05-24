<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderChat extends Model{

    use HasFactory;

    protected $fillable = [
        'order_id',
        'message',
        'user_id',
    ];
    
    public function order(): BelongsTo{
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
