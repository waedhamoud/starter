<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\OfferScope;

class Offer extends Model
{
    protected $table ="offers";
    protected $fillable = ['name' ,'photo' ,'price' ,'details','status', 'created_at' , 'updated_at'];
    protected $hidden = ['created_at' , 'updated_at',]; // when i select from database these are hidden
    //public $timestamps = false;

    ############ Register global scpe ###############
    protected static function boot()
    {   parent::boot();


        static::addGlobalScope(new OfferScope);
    }

    ############## Local Scopes #################
    public function scopeInactive($query){
       return $query -> where('status',0);

    }
    public function scopeInvalid($query){
        return $query -> where('status',0)->whereNull('details');

     }
     ##############################################
     public function setNAMEAttribute($value){
        $this -> attributes['name'] = strtoupper($value);

     }


}

