<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'role_id',
        'formation_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules = [
        'name' => ['required', 'string', 'max:255'],
        'firstname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'formation_id' => ['integer'],
        'role_id' => ['required', 'integer'],
    ];

    public function formation(){
        return $this->hasOne('App\Models\Formation', 'id', 'formation_id');
    }

    public function role(){
        return $this->hasOne('App\Models\Role', 'id', 'role_id');
    }

    public function groups(){
        return $this->belongsToMany('App\Models\Group', 'users_groups', 'user_id', 'group_id');
    }

    public function subjects(){
        return $this->belongsToMany('App\Models\Subject', 'users_subjects', 'user_id', 'subject_id');
    }

    public function sessions(){
        return $this->hasMany('App\Models\Session', 'group_id', 'id');
    }

    public function sessionsP(){
        return $this->belongsToMany('App\Models\Session', 'presence', 'user_id', 'status_id', 'session_id');
    }

    public function states(){
        return $this->belongsToMany('App\Models\State', 'presence', 'user_id', 'state_id');
    }
}
