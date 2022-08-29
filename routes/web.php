<?php
use App\Http\Controllers\CetakController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;

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
});

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('profile', 'ProfileController@index');
    Route::get('profile/edit', 'ProfileController@edit');
    Route::patch('profile/{user}', 'ProfileController@update');
    
    Route::get('members/get-json', 'MemberController@jsonMembers');
    Route::get('members/print', [MemberController::class,'print']);
    Route::resource('members', 'MemberController');
    
    Route::get('users/get-json', 'UserController@jsonUsers');
    Route::get('users/print', [UserController::class,'print']);
    Route::resource('users', 'UserController');

    Route::get('pinjaman/get-json', 'PinjamanController@jsonPinjaman');
    Route::get('pinjaman/print/{id}', 'PinjamanController@cetak');
    Route::resource('pinjaman', 'PinjamanController')->only([
        'index', 'create', 'store', 'show'
    ]);
    
    Route::get('angsurankredit/bayar/{id}', 'AngsuranKreditController@bayar');
    Route::get('angsuranpinjaman/bayar/{id}', 'AngsuranPinjamanController@bayar');
    
    Route::get('kredit/get-json', 'KreditController@jsonKredit');
    Route::get('kredit/print/{id}', 'KreditController@cetak');
    Route::resource('kredit', 'KreditController')->only([
        'index', 'create', 'store', 'show'
    ]);

});
