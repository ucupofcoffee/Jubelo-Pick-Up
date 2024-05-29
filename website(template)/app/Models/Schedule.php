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
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class, 'typeid', 'typeid');
    }
}
