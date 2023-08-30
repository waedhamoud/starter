<?php

namespace App\Http\Controllers;
use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use LaravelLocalization;
use App\Scopes\OfferScope;

class CrudController extends Controller
{
    use OfferTrait;
    public function __construct (){

    }

    public function getOffers()
    {
        return Offer::select('id','name')->get();

    }
   /* public function store(){
        Offer::create([
            'name' => 'offer 2',
            'price' => '5000',
            'details' => 'offer details',

        ]);
    }*/
    public function create(){


        return view('offers.create');
    }

    public function store(OfferRequest $request){






      /*  $messages = $this -> getMessages();
        $rules = $this -> getRules();
       //validate data before insert to database
       $validator = Validator::make($request -> all(),$rules,$messages);
       if ($validator -> fails()){
        return redirect() -> back()-> withErrors($validator) -> withInputs($request -> all());

       }*/
       //insert
       $file_name = $this -> saveImage($request -> photo ,'images/offers');
       Offer::create([
        'photo' => $file_name,
        'name' => $request -> name,
        'price' => $request -> price ,
        'details' => $request -> details,
       ]);
       return redirect() -> back()->with(['success' => 'offer added successfuly']);

       return 'saved successfuly';



    }

  /*  protected function getMessages(){
        return  $messages = [
            'name.required' => __('messages.offer name required'),
        'name.uniqe' => __('meassages.offer name must be uniqe'),
        'price.required' => 'neccessary ',];
    }
    protected function getRules(){
        return  $rules = ['name'=>'required|max:100|unique:offers,name',
        'price'=>'required|numeric',
        'details'=>'required', ];
    } */
    public function getAllOffers(){
     /* $offers = Offer::select('id','name','price','details')->get();//return collection
      return view('offers.all',compact('offers'));*/
       ############ Paginate result ###################
       $offers = Offer::select('id','name','price','details')->paginate(PAGINATION_COUNT);//return collection
       //return view('offers.all',compact('offers'));
       return view('offers.pagination',compact('offers'));



    }
    public function editOffer($offer_id){
        //Offer::findorFail($offer_id); // if the id found return it or return not found
        $offer= Offer::find($offer_id);
        if(!$offer)
        return redirect() -> back();
        $offer= Offer::select('id','name','price','details')->find($offer_id);
        return view('offers.edit', compact('offer'));

      // return $offer_id;

    }

    public function deleteOffer($offer_id){
        //check if offer id exists
        $offer= Offer::find($offer_id);// another method Offer::where ('id','','$offer_id') -> first();
        if(!$offer)
        return redirect() -> back() -> with(['error' => 'Not Found']);
        else
        $offer -> delete();
        return redirect()->route('offers.all',$offer_id)-> with(['success' => 'Offer Deleted']);






    }

    public function updateOffer(OfferRequest $request,$offer_id){
        //validation request

        //check if offer is existst
        $offer= Offer::find($offer_id);
        if(!$offer)
        return redirect() -> back();


        //update database
        $offer-> update ($request -> all());
        return redirect()->back() -> with(['sucess'=>'updated successfully']);




    }
    public function getVideo(){
       $video = Video::first();

       event(new VideoViewer( $video ));
        return view('video') -> with('video' ,$video );

    }
    public function getAllInactiveOffers(){
        //where    wherNull    whereNotNull     wherein

      //return $inactiveoffers =  Offer::inactive()->get();  // all inactive offers
     // return $inactiveoffers =  Offer::invalid()->get();
     ############# Global Scope################
    // return $inactiveoffers =  Offer::get();

     // How to remove global scope
     return $offer = Offer::withoutGlobalScope(OfferScope::class)->get();


    }






}
