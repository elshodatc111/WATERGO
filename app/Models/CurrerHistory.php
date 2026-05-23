<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrerHistory extends Model{

    use HasFactory;

    protected $fillable = [
        'currer_id',
        'type',
        'count',
        'description',
        'status',
        'user_id'
    ];
        
    public function currer(): BelongsTo{
        return $this->belongsTo(User::class, 'currer_id');
    }
    public function omborchi(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}