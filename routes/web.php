<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\ParserController;
use App\Http\Controllers\Account\IndexController as AccountController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;

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


Route::get('/news', [NewsController::class, 'index'])
	->name('news');
Route::get('/news/{news}', [NewsController::class, 'show'])
	->where('news', '\d+')
	->name('news.show');

Route::group(['middleware' => 'auth'], function() {

	Route::group(['prefix' => 'account', 'as' => 'account.'], function() {
		Route::get('/', AccountController::class)
			->name('index');
		//logout
		Route::get('logout', function () {
			Auth::logout();
			return redirect()->route('login');
		})->name('logout');
	});

    //Admin routes
	Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin.check'], function () {
		Route::get('/', AdminController::class)
			->name('index');

		Route::get('parser', ParserController::class)
			->name('parser');

		Route::resource('categories', AdminCategoryController::class);
		Route::resource('news', AdminNewsController::class);
	});
});


Route::get('example', function() {
	$array = ['names' => ["Mike", "Pike"], "name" => ["Ann", "Kate", "Jhon", "Chris", "Ivan", "Julie"]];
	$collection = collect($array);

	dd($collection->collapse());

});

Route::get('session', function () {
	$name = 'exampleSession';
	if(session()->has($name)) {
		//dd(session()->all(), session()->get($name));
		session()->forget($name);
	}

	session([$name => 'test']);

});
Auth::routes();
// socials routes
Route::group(['middleware' => 'guest'], function() {
	Route::get('/auth/{network}/redirect', [SocialController::class, 'index'])
		->where('network', '\w+')
		->name('auth.redirect');
	Route::get('/auth/{network}/callback', [SocialController::class, 'callback'])
		->where('network', '\w+')
		->name('auth.callback');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
