<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $primaryKey = 'scheduleid';
    protected $guarded = [];
    protected $casts = [
        'photo_ids' => 'array'
    ];
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class, 'typeid', 'typeid');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driverid', 'driverid');
    }
}
