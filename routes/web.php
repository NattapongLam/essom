<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Employee\EmployeeFormPage;
use App\Http\Livewire\Employee\EmployeeListPage;
use App\Http\Livewire\Employee\RolePermissionPage;

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
    Route::get('/role-permission/{id}',RolePermissionPage::class)->name('role.permission');
});
Route::resource('/pd-noti' , App\Http\Controllers\ProductionNotice::class);
Route::post('/getData' , [App\Http\Controllers\ProductionNotice::class , 'getData']);
Route::post('/cancelDocsNotice' , [App\Http\Controllers\ProductionNotice::class , 'cancelDocsNotice']);
Route::resource('/del-order' , App\Http\Controllers\DeliveryOrder::class);
Route::post('/getDataDel' , [App\Http\Controllers\DeliveryOrder::class , 'getDataDel']);
Route::resource('/pd-open' , App\Http\Controllers\ProductionOpen::class);
Route::post('/getData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getDataOpen']);
Route::post('/getLogData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getLogDataOpen']);
Route::resource('/pd-work' , App\Http\Controllers\ProductionWorkOrder::class);
Route::post('/getData-Work' , [App\Http\Controllers\ProductionWorkOrder::class , 'getDataWork']);
Route::resource('/pd-ladi' , App\Http\Controllers\ProductionLadingOrder::class);
Route::post('/getData-Ladi' , [App\Http\Controllers\ProductionLadingOrder::class , 'getDataLadi']);
Route::post('/getProduct' , [App\Http\Controllers\ProductionLadingOrder::class , 'getProduct']);
Route::resource('/pd-retu' , App\Http\Controllers\ProductionReturnOrder::class);
Route::post('/getData-Retu' , [App\Http\Controllers\ProductionReturnOrder::class , 'getDataRetu']);
Route::resource('/pd-requ' , App\Http\Controllers\ProductionRequestOrder::class);
Route::post('/getData-Requ' , [App\Http\Controllers\ProductionRequestOrder::class , 'getDataRequ']);
Route::resource('/pd-woho' , App\Http\Controllers\ProductionWorkingHours::class);
Route::post('/getData-Woho' , [App\Http\Controllers\ProductionWorkingHours::class , 'getDataWoho']);
Route::post('/getEmployee' , [App\Http\Controllers\ProductionWorkingHours::class , 'getEmployee']);
Route::post('/cancelDocsMan' , [App\Http\Controllers\ProductionWorkingHours::class , 'cancelDocsMan']);
Route::get('/employee/jobs', [App\Http\Controllers\ProductionWorkingHours::class, 'getJobs'])->name('employee.jobs');
Route::resource('/fl-inst' , App\Http\Controllers\FinalInspection::class);
Route::post('/getData-Inst' , [App\Http\Controllers\FinalInspection::class , 'getDataInst']);
Route::resource('/pd-close' , App\Http\Controllers\ProductionClose::class);
Route::post('/getData-Close' , [App\Http\Controllers\ProductionClose::class , 'getDataClose']);
Route::post('/getLogData-Close' , [App\Http\Controllers\ProductionClose::class , 'getLogDataClose']);
Route::resource('/pd-calendar' , App\Http\Controllers\ProductionCalendar::class);
Route::post('/pd-calendar/getDataProductioncalendar' , [App\Http\Controllers\ProductionCalendar::class , 'getDataProductioncalendar']);
Route::post('/pd-popup-calendar' , [App\Http\Controllers\ProductionCalendar::class , 'popupCalendar']);
Route::post('/pd-calendar-filter' , [App\Http\Controllers\ProductionCalendar::class , 'filterCalendar']);
Route::resource('/pd-follow' , App\Http\Controllers\ProductionFollow::class);
Route::resource('/wh-stock' , App\Http\Controllers\WareHouseStock::class);
Route::resource('/mn-report' , App\Http\Controllers\ManhourReport::class);
Route::post('/getData-ManHour' , [App\Http\Controllers\ManhourReport::class , 'getDataManHour']);
Route::resource('/cm-report' , App\Http\Controllers\CostMaterialReport::class);
Route::post('/getData-Cost' , [App\Http\Controllers\CostMaterialReport::class , 'getDataCost']);
Route::resource('/ncr-report' , App\Http\Controllers\NcrReport::class);
Route::post('/cancelDocsNcr' , [App\Http\Controllers\NcrReport::class , 'cancelDocsNcr']);
Route::resource('/car-report' , App\Http\Controllers\CarReport::class);
Route::post('/cancelDocsCar' , [App\Http\Controllers\CarReport::class , 'cancelDocsCar']);
Route::resource('/fl-form' , App\Http\Controllers\FinalInspectionForm::class);

// ISO 30 //
Route::resource('/documents' , App\Http\Controllers\MainDocument::class);
Route::resource('/assessrisk' , App\Http\Controllers\IsoAssessrisk::class);
Route::post('/cancelAssessrisk' , [App\Http\Controllers\IsoAssessrisk::class , 'cancelAssessrisk']);
Route::post('/approvedAssessrisk' , [App\Http\Controllers\IsoAssessrisk::class , 'approvedAssessrisk']);
Route::resource('/assessrisk-swot' , App\Http\Controllers\IsoAssessriskSwot::class);
Route::resource('/objcctives' , App\Http\Controllers\IsoObjcctives::class);
Route::resource('/iso-plan' , App\Http\Controllers\IsoPlan::class);
Route::resource('/maintenance-records' , App\Http\Controllers\IsoMaintenanceRecords::class);
Route::resource('/machine-history' , App\Http\Controllers\IsoMachineHistory::class);
Route::resource('/computer-history' , App\Http\Controllers\IsoComputerHistory::class);
Route::get('/computer-history/{id}/popup', [App\Http\Controllers\IsoComputerHistory::class, 'popup']);
Route::resource('/computer-records' , App\Http\Controllers\IsoComputerRecords::class);
Route::resource('/email-registration' , App\Http\Controllers\IsoEmailRegistration::class);
Route::resource('/knowledge-survey' , App\Http\Controllers\IsoKnowledgesurvey::class);
Route::resource('/knowledge-record' , App\Http\Controllers\IsoKnowledgerecord::class);
Route::resource('/knowledge-transfer' , App\Http\Controllers\IsoKnowledgetransfer::class);
Route::resource('/knowledge-register' , App\Http\Controllers\IsoKnowledgeregister::class);
Route::resource('/document-register' , App\Http\Controllers\IsoDocumentregister::class);
Route::resource('/document-distribution' , App\Http\Controllers\IsoDocumentdistribution::class);
Route::post('/cancelDistribution' , [App\Http\Controllers\IsoDocumentdistribution::class , 'cancelDistribution']);
Route::post('/approvedDistribution' , [App\Http\Controllers\IsoDocumentdistribution::class , 'approvedDistribution']);
Route::resource('/document-correction' , App\Http\Controllers\IsoDocumentcorrection::class);
Route::post('/cancelCorrection' , [App\Http\Controllers\IsoDocumentcorrection::class , 'cancelCorrection']);
Route::resource('/document-destruction' , App\Http\Controllers\IsoDocumentdestruction::class);
Route::post('/cancelDestruction' , [App\Http\Controllers\IsoDocumentdestruction::class , 'cancelDestruction']);
Route::resource('/document-external' , App\Http\Controllers\IsoDocumentexternal::class);
Route::post('/cancelExternalHd' , [App\Http\Controllers\IsoDocumentexternal::class , 'cancelExternalHd']);
Route::post('/cancelExternalDt' , [App\Http\Controllers\IsoDocumentexternal::class , 'cancelExternalDt']);
Route::resource('/document-reference' , App\Http\Controllers\IsoDocumentreference::class);
Route::post('/cancelReference' , [App\Http\Controllers\IsoDocumentreference::class , 'cancelReference']);
Route::resource('/design-plan' , App\Http\Controllers\IsoDesignPlan::class);
Route::resource('/design-review-a' , App\Http\Controllers\IsoDesignReviewA::class);
Route::post('/cancelReviewAHd' , [App\Http\Controllers\IsoDesignReviewA::class , 'cancelReviewAHd']);
Route::post('/cancelReviewADt' , [App\Http\Controllers\IsoDesignReviewA::class , 'cancelReviewADt']);
Route::resource('/design-review-b' , App\Http\Controllers\IsoDesignReviewB::class);
Route::post('/cancelReviewB' , [App\Http\Controllers\IsoDesignReviewB::class , 'cancelReviewB']);
Route::resource('/detailed-testing' , App\Http\Controllers\IsoDetailedTesting::class);
Route::post('/cancelTesting' , [App\Http\Controllers\IsoDetailedTesting::class , 'cancelTesting']);
Route::resource('/design-edit' , App\Http\Controllers\IsoDesignEdit::class);
Route::post('/cancelDesignedit' , [App\Http\Controllers\IsoDesignEdit::class , 'cancelDesignedit']);
Route::resource('/product-registration' , App\Http\Controllers\IsoProductRegistration::class);
Route::post('/cancelRegistrationHd' , [App\Http\Controllers\IsoProductRegistration::class , 'cancelRegistrationHd']);
Route::post('/cancelRegistrationDt' , [App\Http\Controllers\IsoProductRegistration::class , 'cancelRegistrationDt']);
Route::resource('/quality-plan' , App\Http\Controllers\IsoQualityPlan::class);
Route::post('/cancelQualityplanHd' , [App\Http\Controllers\IsoQualityPlan::class , 'cancelQualityplanHd']);
Route::post('/cancelQualityplanDt' , [App\Http\Controllers\IsoQualityPlan::class , 'cancelQualityplanDt']);
Route::resource('/product-selection' , App\Http\Controllers\IsoProductSelection::class);
Route::post('/cancelProductSelectionHd' , [App\Http\Controllers\IsoProductSelection::class , 'cancelProductSelectionHd']);
Route::post('/cancelProductSelectionDt' , [App\Http\Controllers\IsoProductSelection::class , 'cancelProductSelectionDt']);
Route::post('/ApprovedProductSelectionHd' , [App\Http\Controllers\IsoProductSelection::class , 'ApprovedProductSelectionHd']);
Route::resource('/recipient-selection' , App\Http\Controllers\IsoRecipientSelection::class);
Route::post('/cancelRecipientSelection' , [App\Http\Controllers\IsoRecipientSelection::class , 'cancelRecipientSelection']);
Route::post('/ApprovedRecipientSelection' , [App\Http\Controllers\IsoRecipientSelection::class , 'ApprovedRecipientSelection']);
Route::resource('/product-list-selected' , App\Http\Controllers\IsoProductListSelected::class);
Route::post('/cancelProductListSelectedHd' , [App\Http\Controllers\IsoProductListSelected::class , 'cancelProductListSelectedHd']);
Route::post('/cancelProductListSelectedDt' , [App\Http\Controllers\IsoProductListSelected::class , 'cancelProductListSelectedDt']);
Route::resource('/software-design' , App\Http\Controllers\IsoSoftwareDesign::class);
Route::post('/cancelSoftwareDesignHd' , [App\Http\Controllers\IsoSoftwareDesign::class , 'cancelSoftwareDesignHd']);
Route::post('/cancelSoftwareDesignDt' , [App\Http\Controllers\IsoSoftwareDesign::class , 'cancelSoftwareDesignDt']);
Route::post('/approvedSoftwareDesign' , [App\Http\Controllers\IsoSoftwareDesign::class , 'approvedSoftwareDesign']);
// ISO 30 //