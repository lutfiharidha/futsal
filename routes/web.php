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
use Illuminate\Http\Request;
Route::get('/success/{id}/{name}', 'WelcomeController@success')->name('success');

Route::get('/', 'WelcomeController@index')->name('index');
Route::get('/tournament/{id}/{tournament}','WelcomeController@viewtour')->name('tour.view');
Route::post('/tournament/{id}/{tournament}','WelcomeController@storetour')->name('tour.store');
Route::get('/payment/tournament/{id}/{tournament}','WelcomeController@paytour')->name('pay.tour');
Route::post('/payment/tournament/{id}/{tournament}','WelcomeController@paystore')->name('pay.store');
Route::get('/payment/booking/{id}/{name}','WelcomeController@paybook')->name('pay.book');
Route::post('/payment/booking/{id}/{name}','WelcomeController@sbook')->name('sbook');
Route::get('/tournaments/','WelcomeController@tour')->name('tour');
Route::get('/get-city/{provinceId}','WelcomeController@prov')->name('prov');
Route::get('/tanggal/{tangal}','WelcomeController@time')->name('time');
Route::get('/booking/user/{id}','WelcomeController@bo')->name('user');
Route::get('/booking/{id}/{name}','WelcomeController@book')->name('book');
Route::post('/booking/{id}/{name}','WelcomeController@bookstore')->name('bookstore');
Route::post('/contact','WelcomeController@cont')->name('contact');
// Route untuk user yang baru register
Route::group(['prefix' => 'home', 'middleware' => ['auth']], function(){
	Route::get('/', function(){
		$data['role'] = \App\UserRole::whereUserId(Auth::id())->get();
		return view('home', $data);
	});
	Route::get('/member/account/', 'MemberController@index')->name('data.account');
	Route::get('/member/account/update', 'MemberController@account')->name('saccount');
	Route::patch('/member/account/update', 'MemberController@supdate')->name('supdate');
	Route::patch('/member/account/coupon', 'MemberController@coupon')->name('coupon');
});
// Route untuk user yang admin
Route::group(['prefix' => 'dashboard','middleware' => ['auth','role:admin']], function(){
	Route::get('/', function(){
		$data['users'] = \App\User::whereDoesntHave('roles')->paginate(3);
		return view('admin', $data);
	});
    Route::get('/admin/contact', 'AdminController@indexcontact')->name('data.contact');
Route::get('/admin/member', 'AdminController@indexmember')->name('data.member');
    Route::get('/admin/r/member', 'AdminController@createmember')->name('add.member');
    Route::post('/admin/r/member', 'AdminController@storemember')->name('storemember');
    Route::get('/admin/member/{id}', 'AdminController@editmember')->name('edit.member');
	Route::patch('/admin/member/{id}', 'AdminController@updatemember')->name('update.member');
    Route::delete('/admin/delete/member/{user}', 'AdminController@memberdestroy')->name('member.destroy');
    Route::patch('/admin/member/coupon/{id}', 'AdminController@updatecoupon')->name('update.coupon');
    Route::patch('/admin/member/add/{id}', 'AdminController@addcoupon')->name('add.coupon');
    /**TOURNAMENT**/
    Route::get('/admin/tournament', 'TournamentController@index')->name('data.tournament');
    Route::get('/admin/r/tournament', 'TournamentController@createtour')->name('add.tournament');
    Route::post('/admin/r/tournament', 'TournamentController@storetour')->name('store.tournament');
    Route::get('/admin/tournament/{id}', 'TournamentController@edittour')->name('edit.tour');
	Route::patch('/admin/tournament/{id}', 'TournamentController@updatetour')->name('update.tour');
    Route::delete('/admin/delete/tournament/{tournament}', 'TournamentController@destroytour')->name('destroy.tour');
     Route::get('/admin/tournament/{id}/{tournament}', 'TournamentController@viewtour')->name('view.tour');
      Route::patch('/admin/tournament/user/{id}/{tournament}', 'TournamentController@edituser')->name('edit.user');
    /**END**/
    /**FIELDS**/
    Route::get('/admin/field', 'FieldController@index')->name('data.field');
    Route::get('/admin/r/field', 'FieldController@createfield')->name('add.field');
    Route::post('/admin/r/field', 'FieldController@storefield')->name('store.field');
    Route::get('/admin/field/{id}', 'FieldController@editfield')->name('edit.field');
	Route::patch('/admin/field/{id}', 'FieldController@updatefield')->name('update.field');
    Route::delete('/admin/delete/field/{field}', 'FieldController@destroyfield')->name('field.destroy');
    /**END**/
    /**BOOKING**/
    Route::get('/admin/booking/{id}', 'FieldController@viewbook')->name('data.booking');
    Route::patch('/admin/booking/user/{id}', 'FieldController@editbook')->name('edit.book');
    /**END**/
    /**Testi**/
    Route::get('/admin/testi', 'AdminController@testi')->name('data.testi');
    Route::get('/admin/r/testi', 'AdminController@createtesti')->name('add.testi');
    Route::post('/admin/r/testi', 'AdminController@storetesti')->name('store.testi');
    Route::get('/admin/testi/{id}', 'AdminController@edittesti')->name('edit.testi');
    Route::patch('/admin/testi/{id}', 'AdminController@updatetesti')->name('update.testi');
    Route::delete('/admin/delete/testi/{testi}', 'AdminController@testidestroy')->name('testi.destroy');
    /**END**/
    });
// Route untuk user yang member
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth','role:member']], function(){
	Route::get('/', function(){
		return view('member');
	});
});
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');