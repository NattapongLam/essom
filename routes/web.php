<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Employee\EmployeeFormPage;
use App\Http\Livewire\Employee\EmployeeListPage;

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

Route::get('/',[DashboardController::class,'index'] );

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group([
    'prefix' => 'employees',
    'as' => 'employee.'
],function(){
    Route::get('/', EmployeeListPage::class)->name('list');
    Route::get('/create', EmployeeFormPage::class)->name('create');
    Route::get('/update/{id}', EmployeeFormPage::class)->name('update');
});
Route::resource('/pd-noti' , App\Http\Controllers\ProductionNotice::class);
Route::post('/getData' , [App\Http\Controllers\ProductionNotice::class , 'getData']);
Route::resource('/del-order' , App\Http\Controllers\DeliveryOrder::class);
Route::post('/getDataDel' , [App\Http\Controllers\DeliveryOrder::class , 'getDataDel']);
Route::resource('/pd-open' , App\Http\Controllers\ProductionOpen::class);
Route::post('/getData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getDataOpen']);
Route::resource('/pd-work' , App\Http\Controllers\ProductionWorkOrder::class);
Route::post('/getData-Work' , [App\Http\Controllers\ProductionWorkOrder::class , 'getDataWork']);
Route::resource('/pd-ladi' , App\Http\Controllers\ProductionLadingOrder::class);
Route::post('/getData-Ladi' , [App\Http\Controllers\ProductionLadingOrder::class , 'getDataLadi']);
Route::resource('/pd-retu' , App\Http\Controllers\ProductionReturnOrder::class);
Route::post('/getData-Retu' , [App\Http\Controllers\ProductionReturnOrder::class , 'getDataRetu']);
Route::resource('/pd-requ' , App\Http\Controllers\ProductionRequestOrder::class);
Route::post('/getData-Requ' , [App\Http\Controllers\ProductionRequestOrder::class , 'getDataRequ']);
Route::resource('/pd-woho' , App\Http\Controllers\ProductionWorkingHours::class);
Route::post('/getData-Woho' , [App\Http\Controllers\ProductionWorkingHours::class , 'getDataWoho']);
Route::post('/getEmployee' , [App\Http\Controllers\ProductionWorkingHours::class , 'getEmployee']);
Route::post('/cancelDocsMan' , [App\Http\Controllers\ProductionWorkingHours::class , 'cancelDocsMan']);
Route::resource('/fl-inst' , App\Http\Controllers\FinalInspection::class);
Route::post('/getData-Inst' , [App\Http\Controllers\FinalInspection::class , 'getDataInst']);
Route::resource('/pd-close' , App\Http\Controllers\ProductionClose::class);
Route::post('/getData-Close' , [App\Http\Controllers\ProductionClose::class , 'getDataClose']);
Route::resource('/pd-calendar' , App\Http\Controllers\ProductionCalendar::class);
Route::post('/pd-calendar/getDataProductioncalendar' , [App\Http\Controllers\ProductionCalendar::class , 'getDataProductioncalendar']);
Route::resource('/pd-follow' , App\Http\Controllers\ProductionFollow::class);
Route::resource('/wh-stock' , App\Http\Controllers\WareHouseStock::class);
Route::resource('/mn-report' , App\Http\Controllers\ManhourReport::class);
Route::post('/getData-ManHour' , [App\Http\Controllers\ManhourReport::class , 'getDataManHour']);
Route::resource('/cm-report' , App\Http\Controllers\CostMaterialReport::class);
Route::post('/getData-Cost' , [App\Http\Controllers\CostMaterialReport::class , 'getDataCost']);
Route::resource('/ncr-report' , App\Http\Controllers\NcrReport::class);
Route::resource('/car-report' , App\Http\Controllers\CarReport::class);

