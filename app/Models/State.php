<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'stt_name'
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'presence', 'statut_id', 'user_id');
    }

    public function sessions(){
        return $this->belongsToMany('App\Models\Session', 'presence', 'statut_id', 'session_id');
    }
}
