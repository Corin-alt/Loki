<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'fmt_name'
    ];

    public static $rules =  [
        'fmt_name' => ['required', 'string', 'max:255']
    ];

    public function groups(){
        return $this->hasMany('App\Models\Group', 'formation_id', 'id');
    }

    public function subjects(){
        return $this->hasMany('App\Models\Subject', 'formation_id', 'id');
    }

    public function users(){
        return $this->hasMany('App\Models\User', 'formation_id', 'id');
    }

}
