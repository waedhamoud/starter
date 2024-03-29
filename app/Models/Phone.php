<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = 'phone';
    protected $fillable = ['code' ,'phone','user_id' ];
    protected $hidden = ['user_id' ];

    public $timestamps = false;

     ###############  Begin relations ###########
     public function user(){
        return $this -> beLongsTo('App\Models\User','user_id');

    }



    ###############  End relations #############
}
