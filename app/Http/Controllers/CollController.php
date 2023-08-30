<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollController extends Controller
{
    public function index(){
     /*   $numbers = [1,2,3,4];
    $col = collect($numbers);
   // return $col ;

    return $col -> avg(); */
   /*  $names = collect (['name','age']);
   $res =  $names -> combine (['ahmed','28']);
   return $res; */


   /* $ages = collect([2,3,5,6,7,9]);
  return $ages -> count(); */

 /* $ages = collect([2,3,3,6,6,9]);
  return $ages -> countBy(); */

  $ages = collect([2,3,3,6,6,9]);
  return $ages -> duplicates();





   }
}
