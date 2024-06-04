<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $table = 'histories';
    protected $primaryKey = 'historyid';
    protected $guarded = [];
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(Type::class, 'typeid', 'typeid');
    }
}
