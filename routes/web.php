<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SettingOpnameReportController;
use App\Http\Controllers\SettingJobRequestController;
use App\Http\Controllers\SettingQuotationController;
use App\Http\Controllers\SettingWorkOrderController;
use App\Http\Controllers\SettingSNoteController;
use App\Http\Controllers\SettingLapdocController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\JobRequestItemController;
use App\Http\Controllers\JobRequestExportController;
use App\Http\Controllers\WorkOrderItemController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationExportController;
use App\Http\Controllers\QuotationItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OpnameReportController;
use App\Http\Controllers\SNoteController;




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
    return redirect()->route('login');
});


// Route::middleware(['guest'])->group(function ()
// {
  Route::get('login', [LoginController::class, 'index']);

  Route::post('login', [LoginController::class, 'authenticate'])->name('login');

  Route::post('forget-password', [LoginController::class, 'forgetPassword'])->name('forgetPassword');

  Route::get('forget-password/redirect/', [LoginController::class, 'forgetPasswordRedirect'])->name('forget_password.redirect');

  Route::get('reset-password/{id}', [LoginController::class, 'indexResetPassword'])->name('reset_password.index');

  Route::post('reset-password/{id}', [LoginController::class, 'resetPassword'])->name('reset_password');

// });

Route::middleware(['auth'])->group(function ()
{
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('dashboard', DashboardController::class)->only('index');

    Route::get('dashboard/edit', [DashboardController::class, 'edit']);

    Route::post('dashboard/update', [DashboardController::class, 'update']);

    Route::prefix('dashboard')->name('dashboard.')->group(function ()
    {
        Route::resource('user', UserController::class);

        Route::resource('client', ClientController::class);

        Route::resource('role', RoleController::class);

        Route::resource('project', ProjectController::class);

        Route::get('job-request/{id}/export', JobRequestExportController::class)->name('job-request.export');

        Route::resource('job-request', JobRequestController::class);

        Route::resource('job-request-item', JobRequestItemController::class);

        Route::post('job-request-item/verification', [JobRequestItemController::class, 'verification'])->name('job-request-item.verification');
        
        Route::get('quotation/{id}/export', QuotationExportController::class)->name('quotation.export');

        Route::resource('quotation', QuotationController::class);

        Route::resource('quotation-item', QuotationItemController::class);

        Route::post('quotation-item/verification', [QuotationItemController::class, 'verification'])->name('quotation-item.verification');

        Route::resource('work-order', WorkOrderController::class);

        Route::resource('work-order-item', WorkOrderItemController::class);
        
        Route::resource('opname-report', OpnameReportController::class);
        
        Route::resource('work-order-item', WorkOrderItemController::class);
        
        Route::resource('s-note', SNoteController::class);

        Route::prefix('setting')->name('setting.')->group(function ()
        {
            Route::resource('job-request', SettingJobRequestController::class);
            
            Route::resource('quotation', SettingQuotationController::class);
            
            Route::resource('work-order', SettingWorkOrderController::class);
            
            Route::resource('opname-report', SettingOpnameReportController::class);
            
            Route::resource('s-note', SettingSNoteController::class);
            
            Route::resource('lapdoc', SettingLapdocController::class);
        });
    });

});
