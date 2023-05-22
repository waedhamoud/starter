<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;

class UserController extends Controller
{
 public function showUserName(){
    return 'waed hammoud';

 }
public function getIndex(){
   /* $obj = new \stdClass();
    $obj -> name ='ahmed';
    $obj -> id = 30;
    $obj -> gender = 'male';*/
    $data =['waed' , 'bassem'];
    return view('welcome',compact('data'));
}

}
