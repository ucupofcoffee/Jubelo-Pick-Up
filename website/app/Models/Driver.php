<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = 'drivers';
    protected $primaryKey = 'driverid';
    protected $guarded = [];
    public $timestamps = false;
}
