<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'grp_name',
        'type_education_id',
        'formation_id',
        'year_id'
    ];

    public static $rules = [
        'grp_name' => ['required', 'string', 'max:255'],
        'type_education_id' => ['required', 'integer'],
        'formation_id' => ['integer'],
        'year_id' => ['required', 'integer'],
    ];

    public function year(){
        return $this->hasOne('App\Models\Year', 'id', 'year_id');
    }

    public function type_education(){
        return $this->hasOne('App\Models\TypeEducations', 'id', 'type_education_id');
    }

    public function formation(){
        return $this->hasOne('App\Models\Formation', 'id', 'formation_id');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User', 'users_groups', 'group_id', 'user_id');
    }

    public function sessions(){
        return $this->hasMany('App\Models\Session', 'group_id', 'id');
    }

}
