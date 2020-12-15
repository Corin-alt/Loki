<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'user_id',
        'state_id',
    ];

    public function state(){
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
}
