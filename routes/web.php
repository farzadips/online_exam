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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/resetpassword','LoginController@reset_index');
Route::post('/resetpassword','LoginController@resetpassword');
Route::get('/signup', 'SignUpController@index');
Route::post('/signup', 'SignUpController@register');
Route::get('/logout','LoginController@logout');


Route::prefix('adminpanel')->group(function (){
    Route::get('/','AdminController@index');
    Route::get('/add_exam','AdminController@add_exam');
    Route::resource('categories','CategoryController');
    Route::post('/delete_exam/{id}','AdminController@delete_exam');
});



Route::post('/submitexam','ExamController@submit');
Route::post('/ajax_upload/action', 'AjaxUploadController@action');
Route::post('/ajax_upload/show', 'AjaxUploadController@show');

Route::get('/userpanel','UserController@index');
Route::get('/exams','ExamController@showexams');
Route::post('/examentry','ExamController@entrycheck');


Route::post('/answersubmit','AnswerController@answersubmit');
Route::get('/results','AnswerController@showinvolvedexams');
Route::post('/estimate','AnswerController@estimate');
Route::get('/kholase','AnswerController@kholase');


Route::get('/news','NewsController@index');
Route::post('/news','NewsController@submit');
Route::get('/shownews','NewsController@shownewstouser');


Route::post('/pay','PayController@order');
Route::get('/verify','PayController@verify');
Route::get('/paymentsuccess',function(){
    return view('paymentsuccess');
});
Route::get('/paymentfail',function(){
//    return view('paymentfail');
    return view('paymentsuccess');

});

Route::get('/setting','UserController@setting');
Route::post('/changeuserinfo','UserController@changeuserinfo');


Route::get('/home', 'HomeController@index')->name('home');