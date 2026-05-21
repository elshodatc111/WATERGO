<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionUser extends Model{

    use HasFactory;

    protected $fillable = [
        'region_id',
        'user_id',
        'status',
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function region(): BelongsTo{
        return $this->belongsTo(Region::class, 'region_id');
    }
}
