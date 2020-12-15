<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'yrs_name'
    ];

    public function group(){
        return $this->hasMany('App\Models\Group', 'year_id', 'id');
    }

    public function subject(){
        return $this->hasMany('App\Models\Subject', 'year_id', 'id');
    }


}
