<?php

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

Auth::routes();

//only logged in users can access the below areas
Route::get('/home', 'HomeController@index')->name('home');

        Route::group(['middleware'=>'auth'], function(){  

        Route::resource('qrcodes', 'QrcodeController');

        Route::resource('transactions', 'TransactionController');

        Route::resource('users', 'UserController');

        Route::resource('accounts', 'AccountController');

        Route::resource('accountHistories', 'AccountHistoryController');

        // authorisation for moderators and  admins only    
        Route::group(['middleware'=>'checkmoderator'], function(){  
           // Route::get('/users', 'UserController@index')->name('users.index');

        });
        // authorisation for admins only 
        Route::resource('roles', 'RoleController')->middleware('checkadmin');
        Route::post('/accounts/apply_for_payout', 'AccountsController@apply_for_payout')->name('accounts.apply_for_payout');
        Route::post('/accounts/mark_as_paid', 'AccountsController@mark_as_paid')->name('accounts.mark_as_paid');

});

