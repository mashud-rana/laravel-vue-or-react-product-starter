<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Health check endpoint for Docker/monitoring
Route::get('/health', function () {
    return response('healthy', 200)
        ->header('Content-Type', 'text/plain');
});

// Landing Page
Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard',[DashboardController::class,'index'] )->name('dashboard');

    Route::get('/load-modal/{page_name}/{param1?}/{param2?}/{param3?}', [CommonController::class, 'loadModal'])->name('load-modal')->where('param1', '(.*)');
    Route::get('/app-language-change/{lang}', [CommonController::class, 'changeLanguage'])->name('app.language.change');
    // COMMON STATUS CHANGE
    Route::post('common/status-change/{id}', [CommonController::class, 'statusChange'])->name('common.status-change');
    // COMMON UPDATE ORDERING
    Route::post('common/ordering', [CommonController::class, 'updateOrdering'])->name('common.ordering');
    // COMMON BULK STATUS CHANGE
    Route::post('common/bulk-status-change', [CommonController::class, 'bulkStatusChange'])->name('common.bulk-status-change');
    // COMMON BULK DELETE
    Route::post('common/bulk-delete', [CommonController::class, 'bulkDestroy'])->name('common.bulk-destroy');


    Route::resource('users',UserController::class);
    Route::resource('settings', SettingController::class)->only(['index', 'store']);
    Route::resource('roles', RoleController::class);
    Route::post('users/bulk-delete', [UserController::class, 'bulk_destroy'])->name('users.bulk-destroy');
//    Route::post('users/bulk-status-change', [UserController::class, 'bulk_status_change'])->name('users.bulk-status-change');

    Route::resource('subscribers', SubscriberController::class);
    Route::put('subscribers/{id}/restore', [SubscriberController::class, 'restore'])->name('subscribers.restore');

    // React Examples Page
    Route::get('/react-examples', function () {
        return view('admin.react-examples');
    })->name('react.examples');
});

require __DIR__.'/auth.php';
