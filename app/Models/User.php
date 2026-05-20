<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'password',
        'type',
        'status',
        'fcm_token',
        'balans',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array{
        return [
            'password' => 'hashed',
            'status' => 'boolean',
            'balans' => 'float',
        ];
    }

    public function isAdmin(): bool{
        return $this->type === 'admin';
    }
    
    public function isDirector(): bool{
        return $this->type === 'drektor';
    }
    
    public function isCourier(): bool{
        return $this->type === 'currer';
    }
    
    public function isOmborchi(): bool{
        return $this->type === 'omborchi';
    }

    public function isOperator(): bool{
        return $this->type === 'operator';
    }
    
    public function isActive(): bool{
        return $this->status === true;
    }
}
