
<?php

use Illuminate\Support\Facades\Auth;

define('PAGINATION_COUNT',3);






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify'=> true ]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth','verified']);
Route::get('/',function(){
return 'Logged Out';
});

Route::get('/dashboard',function(){
    return 'Not Adult';
})->name('not.adult');
Route::get('mail',function(){
    return view('emails.mailuser');
});
Route::get('fillable','CrudController@getOffers');
// Route::group(['prefix'=>'LaravelLocalization::setLocale()','middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function(){


Route::group(['prefix'=>'offers'],function(){

        Route::get('create','CrudController@create');

        Route::get('all','CrudController@getAllOffers')->name('offers.all');

        Route::get('edit/{offer_id}','CrudController@editOffer');

        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');

        Route::get('delete/{offer_id}','CrudController@deleteOffer')->name('offers.delete');

        Route::post('store','CrudController@store')->name('offers.store');

        Route::get('youtube','CrudController@getVideo')-> middleware('auth');

        Route::get('get-all-inactive-offer','CrudController@getAllInactiveOffers');

 // });



  //  Route::get('store','CrudController@store');



});
###############    Begin AJAX ROUTES  #####################
Route::prefix('ajax-offers')->group(function () {
    Route::get('create','OfferController@create');
    Route::post('store','OfferController@store')->name('ajax.offers.store');

});



###############    End AJAX ROUTES  #####################



################ِ  Authentication && Gurads ################
/*Route::prefix('auth')->group(function () {
    Route::get('adults','Auth\CustomAuthController@adult');

});*/

    Route::middleware([ 'auth','CheckAge'])->group(function () {

        Route::get('adult','Auth\CustomAuthController@adult') ->name('adult') ;

    });
    Route::get('site','Auth\CustomAuthController@site') ->name('site') -> middleware('auth:web') ;

    Route::get('admin','Auth\CustomAuthController@admin') ->name('admin') -> middleware('auth:admin') ;

    Route::get('admin/login','Auth\CustomAuthController@adminLogin') ->name('admin.login') ;

    Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin') ->name('save.admin.login') ;


################  END AUTH && GUARD        #################


############# Begin Relation Routes #############
##### begin one to one ######
Route::get('has-one','Relation\RelationsController@hasOneRelation');

Route::get('has-one-reverse','Relation\RelationsController@hasOneRelationReverse');

Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');

Route::get('get-user-not-has-phone','Relation\RelationsController@getUserNotHasPhone');

Route::get('get-user-has-phone-condition','Relation\RelationsController@phoneWithCondition');
##### end one to one ######



##### begin one to many ######
Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctor');

Route::get('hospitals','Relation\RelationsController@hospitals')->name('hospital.all');

Route::get('doctors/{hpspital_id}','Relation\RelationsController@doctors')->name('hospital.doctors');

Route::get('hospitals/{hpspital_id}','Relation\RelationsController@deleteHospital')->name('hospital.delete');

Route::get('hospitals-has-doctors','Relation\RelationsController@hospitalsHasDoctor');

Route::get('hospitals-has-doctors-male','Relation\RelationsController@hopitalsHasOnlyMale');

Route::get('hospitals-not-has-doctor','Relation\RelationsController@hopitalsNotHasDoctors');

##### end one to many ######
##### Begin many to many ######
Route::get('doctors-services','Relation\RelationsController@getDoctorServices');

Route::get('services-doctors','Relation\RelationsController@getServicesDoctor');

Route::get('doctors/services/{doctor_id}','Relation\RelationsController@getDoctorServicesById')->name('doctors.services');

Route::post('saveServicces-to-doctor','Relation\RelationsController@saveServicesToDoctors')->name('save.doctors.services');

##### End many to many ######

##### Begin hasOneThrough  ######
Route::get('has-one-through','Relation\RelationsController@getPatientDoctor');

Route::get('has-many-through','Relation\RelationsController@getCountrytDoctor');

##### End hasOneThrough  ######
################# Begin Accessors & Mutators #################
Route::get('accessors','Relation\RelationsController@getDoctors'); // get data

################# End Accessors & Mutators #################








############# End Relation Routes #############



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
