<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeEducations extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'te_name'
    ];

    public function group(){
        return $this->hasMany('App\Models\Group', 'type_education_id', 'id');
    }
}
