<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

if(!function_exists ( 'authenticate' )){
    function authenticate(){
        $valid_passwords = array ("admin" => "admin2019");
        $valid_users = array_keys($valid_passwords);
    
        $user = !empty($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
        $pass = !empty($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
    
        $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
    
        if (!$validated) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        die ("Not authorized");
        }
    }
}
Route::get('/migrate-fresh', function () {
    authenticate();
    Artisan::call('config:cache');
    Artisan::call('migrate:fresh');
    return "done";
});
Route::get('/migrate', function () {
    authenticate();
    Artisan::call('config:cache');
    Artisan::call('migrate');
    return "done";
});

Route::get('/seed', function () {
    authenticate();
    return Artisan::call('db:seed');
});

Route::get('/link', function () {
    authenticate();
    return Artisan::call('storage:link');
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
