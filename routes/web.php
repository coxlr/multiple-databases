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
	
	$sub = \DB::connection('mysql2')->table('testing_b.user_types')->select('user_types.*');	

	dd(
		\App\User::with('type')->get(),

		\DB::table('testing_a.users')->join('testing_b.user_types as ud', 'ud.user_id', '=', 'users.id')->get(),

		\DB::table('testing_b.user_types')->join('testing_a.users as u', 'user_types.user_id', '=', 'u.id')->get(),

		\DB::table('testing_a.users')->crossJoin('testing_b.user_types as ud')->get(),


		\DB::table('testing_a.users')->joinSub($sub, 'types', function($join){
			$join->on('users.id', '=', 'types.user_id');
		})->get(),


		\App\User::first()->join('testing_b.user_types as ud', 'ud.user_id', '=', 'users.id')->get()

	);
	

});
