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
    return view('welcome');   //// HOME PAGE
});


////////////////SATYAM/////////////////////////////////////////////////////////

	 
Route::get('student_dash','StudentController@dash');
Route::post('ind_reg','StudentController@ind_reg');
Route::get('ind_reg','StudentController@ind_reg');
Route::post('grp_reg','StudentController@grp_reg');
Route::get('home', 'HomeController@index')->name('home');
Route::get('getName','AjaxController@getName');

Route::get('getTeam','AjaxController@getTeam');
Route::get('my_events','StudentController@my_events');
Route::post('addIndMembers','StudentController@addIndMembers');
Route::post('pay_amount','StudentController@pay_amount');
Route::post('complete', 'StudentController@complete');
Route::post('pgRedirect', 'StudentController@pg_redirect');
Route::get('confirm','StudentController@confirm_payment');

Route::get('core_comittee','UtilityController@core_comittee');
Route::get('coming_soon','StudentController@coming_soon');
Route::get('not_found','StudentController@not_found');
Route::get('contact_us','UtilityController@contact_us');
Route::get('redirect','StudentController@redirect');


///////////////////////SOORAJ?//////////////////////////////////////////////



Route::get('/encrypt','HomeController@encrypt');
Auth::routes();

	Route::post('/groupRegistration','HomeController@groupRegistration');
	Route::post('/groupRegistrationSuccess','HomeController@groupRegistrationSuccess');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/login1','HomeController@login');
	Route::get('/enrolledEvents','HomeController@myEvents');
	Route::get('/dash','HomeController@dash');
	Route::post('/grp_reg','HomeController@grp_reg');
	Route::get('getName','HomeController@getName');
	Route::get('/paidStudentReport','TanyaController@individualEvents');
	Route::get('/registeredStudentReport','TanyaController@registeredStudents');
	Route::post('/groupEventDetails','TanyaController@groupEventDetails');
	Route::post('/individualEventDetails','TanyaController@individualEventDetails');


	////////////////////SHREY///////////////////////////////////

	
	Route::get('/addCaptain','adminController@addTeamCaptain');
Route::post('/submit','adminController@submit');
Route::get('/getCaptainName','adminController@getCaptainName');
Route::get('/showStudentCommitee','commiteeController@studentCommittee');
Route::get('/getApexCoordinator','commiteeController@getStudentApexCoordinator');
Route::get('/addCommitteMembers','commiteeController@addApexCoordinator');
Route::get('/removeApexCoordinater','commiteeController@removeCommitteMember');
