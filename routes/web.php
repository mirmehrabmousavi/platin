<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/registration', function () {
    return view('registration');
})->name('registration');

Route::post('/registration', function (Request $request) {
    $serial = $request->productcode;
    $pass = $request->productpass;
    $serialDB = \App\Models\serial::all();
    $passDB = \App\Models\pass::all();
    foreach($serialDB as $valSerial) {
        if ($serial == $valSerial->serialNumber) {
            return back()->with('success',"This Product is orginal. \n It has been Activated before.");
            //dd("Serial Number is OK ".$serial);
        }else{
            return back()->with('danger',"Your code is Incorrect.\nThere is no product with this Code.\nRefresh the page and try again.");
            //dd('serial not Ok'.$serial);
        }
    }

})->name('submitReg');

Route::post('/registration/pass', function (Request $request) {
    $pass = $request->productpass;
    $passDB = \App\Models\pass::all();
    foreach ($passDB as $valPass) {
        if ($pass == $valPass->pass) {
            return back()->with('successPass','The Product Registered and Activated Successfully');
        }else{
            return back()->with('dangerPass','Your Password is Incorrect.
please try again without page refresh. '.$pass);
        }
    }
})->name('submitPass');
