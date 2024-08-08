<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequirementController;
// use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\MessageController;
// use App\Http\Controllers\OrderController;
// use App\Http\Controllers\StructureController;
// use App\Http\Controllers\VacansyController;
// use App\Http\Controllers\NewsController;
// use App\Http\Controllers\PageController;
// use App\Http\Controllers\PermissionController;
// use App\Http\Controllers\GalleryController;
// use App\Http\Controllers\GalleryCategoryController;
// use App\Http\Controllers\TalantController;
// use App\Http\Controllers\AppealController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
// use App\Http\Controllers\NotificationController;
// use App\Http\Controllers\HelpdeskController;
// use App\Http\Controllers\HelpdeskConversationController;
// use App\Http\Controllers\HelpdeskCategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentCirculationController;
use App\Http\Controllers\UserRequirementController;

use App\Http\Controllers\UserrController;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::post('/messages', [MessageController::class, 'sendMessage']);
   
    Route::get('/requirements', [RequirementController::class, 'index'])->name('requirements.index');
    Route::get('/requirements/create', [RequirementController::class, 'create'])->name('requirements.create');
    Route::post('/requirements', [RequirementController::class, 'store'])->name('requirements.store');
    Route::get('/requirements/{requirement}/edit', [RequirementController::class, 'edit'])->name('requirements.edit');
    Route::put('/requirements/{requirement}', [RequirementController::class, 'update'])->name('requirements.update');
    Route::delete('/requirements/{requirement}', [RequirementController::class, 'destroy'])->name('requirements.destroy');

    Route::get('user_requirements', [UserRequirementController::class, 'index'])->name('user_requirements.index');
    Route::get('user_requirements/create', [UserRequirementController::class, 'create'])->name('user_requirements.create');
    Route::post('user_requirements', [UserRequirementController::class, 'store'])->name('user_requirements.store');
    Route::get('user_requirements/{user_requirement}/edit', [UserRequirementController::class, 'edit'])->name('user_requirements.edit');
    Route::patch('user_requirements/{user_requirement}', [UserRequirementController::class, 'update'])->name('user_requirements.update');
    Route::delete('user_requirements/{user_requirement}', [UserRequirementController::class, 'destroy'])->name('user_requirements.destroy');
    Route::patch('user_requirements/{id}/accept', [UserRequirementController::class, 'accept'])->name('user_requirements.accept');
    Route::patch('user_requirements/{id}/reject', [UserRequirementController::class, 'reject'])->name('user_requirements.reject');

    Route::get('/userrs', [UserrController::class, 'index'])->name('userrs.index');
    Route::get('/userrs/create', [UserrController::class, 'create'])->name('userrs.create');
    Route::post('/userrs', [UserrController::class, 'store'])->name('userrs.store');

    Route::get('/chat', [HomeController::class, 'index'])->name('chat');
    Route::get('/conver', [HomeController::class, 'conver'])->name('conver');
    Route::get('/', [HomeController::class, 'index_page'])->name('index_page');
    Route::get('/xeber', [HomeController::class, 'news'])->name('news');
    Route::get('/daxili-xeber', [HomeController::class, 'news_daxili'])->name('news_daxili');
    Route::get('/home', [HomeController::class, 'home'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    
    Route::get('/managment', [HomeController::class, 'managment'])->name('managment');
    Route::get('/partners', [HomeController::class, 'partners'])->name('partners');
    Route::get('/interest', [HomeController::class, 'interest'])->name('interest');
    Route::get('/our-luck', [HomeController::class, 'our_luck'])->name('our_luck');
    Route::get('/all_gallery', [HomeController::class, 'gallery'])->name('gallery');
    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
    Route::get('/category', [ProductCategoryController::class, 'all_category'])->name('all_category');
    Route::post('/report_send', [HomeController::class, 'report_send'])->name('report_send');
    Route::get('/reset', [HomeController::class, 'reset'])->name('reset');
    Route::get('/rasima', [HomeController::class, 'rasima'])->name('rasima');
    Route::resource('/orders', OrderController::class);
    Route::resource('/structure', StructureController::class);
    Route::resource('/vacansy', VacansyController::class);
    Route::resource('/news', NewsController::class);
    Route::resource('/page', PageController::class);
    Route::resource('/permission', PermissionController::class);
    Route::get('/change_permission/{id}/{status}', [PermissionController::class, 'change_permission'])->name('change_permission');
    Route::get('permission/download/{type}', [PermissionController::class, 'downloadExcel'])->name('permissions_download');
    Route::resource('/users', UserController::class);
    Route::resource('/gallery', GalleryController::class);
    Route::resource('/gallery_category', GalleryCategoryController::class);
    Route::resource('/talant', TalantController::class);
    Route::resource('/appeals', AppealController::class);
    Route::resource('/product_category', ProductCategoryController::class);
    Route::resource('/product', ProductController::class);
    Route::get('/all_structure', [HomeController::class, 'all_structure'])->name('all_structure');
    Route::get('/notification/seen/{id}', [NotificationController::class, 'toggle_status'])->name('notification_toggle_status');
    Route::get('/notification/read-all', [NotificationController::class, 'read_all'])->name('notification_read_all');
    Route::resource('/helpdesk', HelpdeskController::class);
    Route::get('/helpdesk/download/{type}', [HelpDeskController::class, 'downloadExcel'])->name('helpdesk_download');
    Route::post('/helpdesk/new-message', [HelpdeskConversationController::class, 'store'])->name('helpdesk_new_message');
    Route::resource('/helpdesk-category', HelpdeskCategoryController::class);
    Route::get('/my-ongoing-desks', [HelpdeskController::class, 'my_ongoing_desks'])->name('my_ongoing_desks');
    Route::get('/document-files', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/test_data', [HomeController::class, 'test_data'])->name('documents.test_data');
    // Route::get('/user-requirements', [UserRequirementController::class, 'index'])->name('user_requirements.index');
    // Route::post('/user-requirements', [UserRequirementController::class, 'store'])->name('user_requirements.store');
    // Route::patch('/user-requirements/{id}', [UserRequirementController::class, 'update'])->name('user_requirements.update');
 
    Route::resource('/document_circulation', DocumentCirculationController::class);
});
Route::get('/hashing', function(){
    return Hash::make('random3003');
});