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
Route::post('/logout','LoginController@logout');


Route::prefix('adminpanel')->group(function (){
    Route::get('/','AdminController@index');
    Route::get('/add_exam','ExamController@add_exam');
    Route::get('/show_students/{id}','ExamController@show_students');
    Route::get('/show_questions/{id}','ExamController@show_questions');
    Route::get('/download/questions/{id}','ExamController@downloadPdf')->name('download');
    Route::resource('categories','CategoryController');
    Route::post('/delete_exam/{id}','ExamController@delete_exam');
    Route::get('/edit_exam/{id}','ExamController@edit_exam');
    Route::post('/submit_edit/{id}','ExamController@submit_edit');
    Route::post('/submit_question_edit/{id}','ExamController@submit_question_edit');
    Route::get('/add-question-to-cart/{id}', 'CartController@addToCart')->name('cart.add');
    Route::get('show_cart','CartController@showCart')->name('cart.show');
    Route::post('/save_cart','CartController@saveCart')->name('cart.save');

});

Route::post('/submitexam','ExamController@submit');
Route::any('/ajax_upload/action', 'AjaxUploadController@action');
Route::post('/ajax_upload/show', 'AjaxUploadController@show');

Route::get('/userpanel','UserController@index');
Route::get('/exams','ExamController@showexams');
Route::get('/myexams','ExamController@showmyexams');
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
