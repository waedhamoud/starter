<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Hospital extends Model
{
    protected $table ="hospitals";
    protected $fillable = [
        'name', 'address' ,'country_id', 'created_at','updated_at'

    ];
    protected $hidden = ['created_at','updated_at'];
    public $timestamps = true;

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor','hospital_id','id');//$this means this class hospital has many doctors, forign key , primary key

    }
}

