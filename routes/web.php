<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\FreindsController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\AllOrdersController;
use App\Http\Controllers\NotifactionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// route::get('invitation', [OrderController::class,"invitation"]);

Route::post('/groups/store1', [GroupsController::class, 'store1'])->name('groups.store1')->middleware('auth');
Route::delete('/groups/destroy1/{id}',[GroupsController::class, 'destroy1'])->name('groups.destroy1')->middleware('auth');
route::get('group-friends/{id}', [GroupsController::class,"show"])->name('group.show')->middleware('auth');
Route::resource('groups', GroupsController::class)->middleware('auth');
Route::delete('deleteFrientoGroub', [GroupsController::class, 'delete'])->name('groups.delete');
Route::resource('friends', FreindsController::class)->middleware('auth');;

Route::resource('orders', OrderController::class)->middleware('auth');
Route::resource('orderdetails', OrderDetailsController::class)->middleware('auth');
Route::resource('allorders', AllOrdersController::class)->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/notifications', [NotifactionController::class, 'getAll'])->name('notifys.all');
Route::get('/notifyseen/{id}', [NotifactionController::class, 'changeSeen']);



//login with google
Route::get('/google/auth/redirect', function () {
    return Socialite::driver('google')->stateless()->redirect();
})->name('login.google');

Route::get('/auth/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();
    $user = User::updateOrCreate([
        'google_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'remember_token' => $googleUser->token,
        'password'=>'',
        'google_id'=>$googleUser->id

    ]);
        Auth::login($user);
        return redirect('/home');
});


//login with facebook
Route::get('auth/facebook/redirect', function () {
    return Socialite::driver('facebook')->stateless()->redirect();
})->name('login.facebook');

Route::get('/auth/facebook/callback', function () {
    $facebookUser = Socialite::driver('facebook')->stateless()->user();
    // dd($facebookUser);
    // $user = User::updateOrCreate([
    //     'facebook_id' => $facebookUser->id,
    // ], [
    //     'name' => $facebookUser->name,
    //     'email' => $facebookUser->email,
    //     'remember_token' => $facebookUser->token,
    //     'password'=>'',
    //     'facebook_id'=>$facebookUser->id

    // ]);
    $user=User::where('email' , '=' , $facebookUser->email)->first();
    if($user){
        $user->facebook_id =$facebookUser->id;
        $user->remember_token = $facebookUser->token;
        $user->update();

    }else {
        $user = User::create([
            'name'=>$facebookUser->name ? $facebookUser->name : $facebookUser->email,
            "email"=>$facebookUser->email,
            'facebook_id'=>$facebookUser->id,
            'remember_token'=>$facebookUser->token,
        ]);
    }
        Auth::login($user);
        return redirect('/home');
    // $user->token
});
