<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Patient;
use App\Models\Country;


class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user = User::with(['phone' => function ($q){

            $q -> select ('code','phone','user_id');

        }]) -> find(14);
       // return $user -> phone -> code;
       // return $user -> phone;
return response() -> json($user);
    }

    public function hasOneRelationReverse(){
        $phone = Phone::with(['user'=> function($q){
            $q -> select ('id','name');
        }])-> find(1);
        // make some attribute visible in this part only
        $phone -> makeVisible(['user_id']);
      //  $phone -> makeHidden(['id']);
      //return $phone -> user ; // retuen user of this phone
       return $phone;


    }
    // get user + phone
    public function getUserHasPhone(){
       return User::whereHas('phone')->get();

    }
    public function getUserNotHasPhone(){
        return User::whereDoesntHave('phone')->get();

    }
    public function phoneWithCondition(){
        return User::whereHas('phone',function($q){
            $q -> where('code','963');

           })->get();
    }
     ############one to many relation methods ########

    public function getHospitalDoctor(){
       $hospital = Hospital::find(1); //  Hospital::where('id',1)->first() ; // Hospital::first();
      // return $hospital -> doctors; //return hospital doctors
      $hospital = Hospital::with ('doctors') -> find(1);
     //return $hospital ->name;
      $doctors= $hospital -> doctors;
      foreach ($doctors as $doctor){
       // echo $doctor -> name .'<br>';

      }
      $doctor = Doctor::find(3);
      return $doctor -> hospital -> name;
    }

    public function hospitals(){
       $hospitals = Hospital::select('id','name','address')-> get();
        return view('doctors.hospitals',compact('hospitals'));

    }
    public function doctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital-> doctors;
       return view('doctors.doctors',compact('doctors'));

    }
    //get all hospitals which must have doctors
    public function hospitalsHasDoctor(){
        return $hospital = Hospital::whereHas('doctors')->get();

    }
    public function hopitalsHasOnlyMale(){
        return $hospital = Hospital::with('doctors')-> whereHas('doctors' , function($q){
            $q -> where('gender',1);

        })->get();

    }
    public function hopitalsNotHasDoctors(){
        return $hospital = Hospital::whereDoesntHave('doctors')->get();
    }
    public function deleteHospital($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital)
        return abort('404');
        $hospital ->  doctors() -> delete();
        $hospital -> delete();
       // return redirect()->route('hospital.all'); // after delete return to the hospital page

    }
    public function getDoctorServices(){

       return $doctor = Doctor::with('services')->find(3);
       // return $doctor->name;

      // return $doctor -> services;

    }
    public function getServicesDoctor(){
        return $doctors = Service::with(['doctors'=>function($q){
            $q -> select ('doctors.id','title' ,'name');

        }])->find(1);


    }
    public function getDoctorServicesById($doctorId){
        $doctor = Doctor::find($doctorId);
        $services = $doctor -> services; // doctor services
        $doctors = Doctor::select('id','name')-> get();
        $allServices = Service::select('id','name')-> get(); // all database services

        return view('doctors.services',compact('services','doctors','allServices'));

    }
    public function saveServicesToDoctors(Request $request){
        $doctor = Doctor::find($request -> doctor_id);

        if(!$doctor)
            return abort('404');
           // $doctor -> services()-> attach($request->servicesIds); // many to many insert to database
          // $doctor -> services()-> sync($request->servicesIds); // يمنع تكرار الخدمة أكثر من مرة sync = update
          $doctor -> services()-> syncWithoutDetaching($request->servicesIds);
            return 'success';



    }
    public function getPatientDoctor(){
         $patient = Patient::find(2);
        return $patient -> doctor;

    }
    public function getCountrytDoctor(){
         $country = Country::find(1);
         return  $country -> doctors;

    }
    public function getDoctors(){
       return $doctors = Doctor::select('id','name','gender')->get();
       /* if(isset($doctors) && $doctors -> count() > 0){
            foreach($doctors as $doctor){
                $doctor -> gender =  $doctor -> gender == 1 ? 'male' : 'female' ;

            }
        }

        return $doctors ;*/
    }


}



