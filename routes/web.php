<?php
use Illuminate\Support\Facades\Hash;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => ['auth']], function () { 
    Route::post('/messages', 'MessageController@sendMessage');

Route::get('/chat', 'HomeController@index')->name('chat');
Route::get('/conver', 'HomeController@conver')->name('conver');
Route::get('/', 'HomeController@index_page')->name('index_page');
Route::get('/xeber', 'HomeController@news')->name('news');
Route::get('/daxili-xeber', 'HomeController@news_daxili')->name('news_daxili');


Route::get('/home', 'HomeController@home')->name('home');

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/managment', 'HomeController@managment')->name('managment');
Route::get('/partners', 'HomeController@partners')->name('partners');
Route::get('/interest', 'HomeController@interest')->name('interest');
Route::get('/our-luck', 'HomeController@our_luck')->name('our_luck');
Route::get('/all_gallery', 'HomeController@gallery')->name('gallery');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/category', 'ProductCategoryController@all_category')->name('all_category');
Route::post('/report_send', 'HomeController@report_send')->name('report_send');


Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/reset', 'HomeController@reset')->name('reset');

Route::get('/rasima', 'HomeController@rasima')->name('rasima');


Route::resource('/users', 'UserController');
Route::resource('/orders', 'OrderController');
Route::resource('/structure', 'StructureController');
Route::resource('/vacansy', 'VacansyController');
Route::resource('/news', 'NewsController');
Route::resource('/page', 'PageController');
Route::resource('/permission', 'PermissionController');
Route::get('/change_permission/{id}/{status}', 'PermissionController@change_permission')->name('change_permission');
Route::get('permission/download/{type}', 'PermissionController@downloadExcel')->name('permissions_download');

Route::resource('/gallery', 'GalleryController');
Route::resource('/gallery_category', 'GalleryCategoryController');

Route::resource('/talant', 'TalantController');

Route::resource('/appeals', 'AppealController');

Route::resource('/product_category', 'ProductCategoryController');
Route::resource('/product', 'ProductController');


Route::get('/all_structure', 'HomeController@all_structure')->name('all_structure');



Route::get('/notification/seen/{id}', 'NotificationController@toggle_status')->name('notification_toggle_status');
Route::get('/notification/read-all', 'NotificationController@read_all')->name('notification_read_all');


Route::resource('/helpdesk', 'HelpdeskController');
Route::get('/helpdesk/download/{type}', 'HelpDeskController@downloadExcel')->name('helpdesk_download');
Route::post('/helpdesk/new-message', 'HelpdeskConversationController@store')->name('helpdesk_new_message');

Route::resource('/helpdesk-category', 'HelpdeskCategoryController');
Route::get('/my-ongoing-desks', 'HelpdeskController@my_ongoing_desks')->name('my_ongoing_desks');

Route::get('/document-files', 'DocumentController@index')->name('documents.index');
Route::get('/test_data', 'HomeController@test_data')->name('documents.test_data');

Route::get('/hashing', function(){
    return Hash::make('KZKS2vSF@');
});
Route::resource('/document_circulation', 'DocumentCirculationController');

});
