<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'sbj_name',
        'user_id',
        'formation_id'
    ];

    public static $rules = [
        'sbj_name' => ['required', 'string', 'max:255'],
        'formation_id' => ['integer'],
        'year_id' => ['required', 'integer'],
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User', 'users_subjects', 'subject_id', 'user_id');
    }

    public function sessions(){
        return $this->hasMany('App\Models\Session', 'subject_id', 'id');
    }

    public function formation(){
        return $this->hasOne('App\Models\Formation', 'id', 'formation_id');
    }

    public function year(){
        return $this->hasOne('App\Models\Year', 'id', 'year_id');
    }
}
