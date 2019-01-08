<?php

use Illuminate\Http\Request;

use App\Contact;

Route::group(['middleware' => 'api'], function () {
    Route::get('contacts', function () {
        return Contact::all();
    });

    Route::get('contact/{id}', function ($id) {
        return Contact::findOrfail($id);
    });

    //Add 
    Route::post('contact/store', function (Request $request) {
        return Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
    });

    // Update
    Route::patch('contact/{id}',function(Request $request,$id){
        Contact::findOrfail($id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);
    });

    // Delete
    Route::delete('contact/{id}', function ($id) {
        return Contact::destroy($id);
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
