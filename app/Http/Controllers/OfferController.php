<?php

namespace App\Http\Controllers;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;


class OfferController extends Controller
{
    use OfferTrait;
    public function create(){
        // view form to add this offer
        return view('ajaxoffers.create');

    }
     public function store(Request $request){
        // save Offer into DB using AJAX
      //  $file_name = $this -> saveImage($request -> photo ,'images/offers');
       Offer::create([
        //'photo' => $file_name,
        'name' => $request -> name,
        'price' => $request -> price ,
        'details' => $request -> details,
       ]);
       return redirect() -> back()->with(['success' => 'offer added successfuly']);



     }
}
