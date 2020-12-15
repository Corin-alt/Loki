<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'date_start',
        'date_end',
        'user_id',
        'subject_id',
        'group_id'
    ];

    public static $rules = [
        'subject_id' => ['required', 'integer'],
        'user_id' => ['required', 'integer'],
        'group_id' => ['required', 'integer'],
        'date_start' => ['required'],
        'date_end' => ['required']
    ];

    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function subject(){
        return $this->hasOne('App\Models\Subject', 'id', 'subject_id');
    }
    public function group(){
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'presence', 'session_id', 'user_id');
    }

    public function states(){
        return $this->belongsToMany('App\Models\State', 'presence', 'session_id', 'state_id');
    }

}
