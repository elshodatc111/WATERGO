<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model{
    use HasFactory;
    
    protected $fillable = [
        'region_id',
        'currer_id',
        'phone',
        'address',
        'order_count',
        'cash',
        'card',
        'bank',
        'full_contaner',
        'empty_contaner',
        'status',
        'description',
        'operator_id'
    ];
    
    protected $casts = [
        'order_count' => 'integer',
        'cash' => 'float',
        'card' => 'float',
        'bank' => 'float',
        'full_contaner' => 'integer',
        'empty_contaner' => 'integer',
    ];
    
    public function region(): BelongsTo{
        return $this->belongsTo(Region::class, 'region_id');
    }

    public function currer(): BelongsTo{
        return $this->belongsTo(User::class, 'currer_id');
    }

    public function operator(): BelongsTo{
        return $this->belongsTo(User::class, 'operator_id');
    }
}
