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
Route::resource('/pd-open' , App\Http\Controllers\ProductionOpen::class);
Route::post('/getData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getDataOpen']);
Route::resource('/pd-work' , App\Http\Controllers\ProductionWorkOrder::class);
