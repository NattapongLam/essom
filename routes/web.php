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
    'as' => 'employee.',
    'middleware' =>  ['auth','permission:setup-users']
],function(){
    Route::get('/', EmployeeListPage::class)->name('list');
    Route::get('/create', EmployeeFormPage::class)->name('create');
    Route::get('/update/{id}', EmployeeFormPage::class)->name('update');
    Route::get('/role-permission/{id}',RolePermissionPage::class)->name('role.permission');
});
Route::group([
    'middleware' =>  ['auth','permission:docu-productionnotices']
],function(){
    Route::resource('/pd-noti' , App\Http\Controllers\ProductionNotice::class);
    Route::post('/getData' , [App\Http\Controllers\ProductionNotice::class , 'getData']);
    Route::post('/cancelDocsNotice' , [App\Http\Controllers\ProductionNotice::class , 'cancelDocsNotice']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-deliveryorders']
],function(){
    Route::resource('/del-order' , App\Http\Controllers\DeliveryOrder::class);
    Route::post('/getDataDel' , [App\Http\Controllers\DeliveryOrder::class , 'getDataDel']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-productionopenjobs']
],function(){
    Route::resource('/pd-open' , App\Http\Controllers\ProductionOpen::class);
    Route::post('/getData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getDataOpen']);
    Route::post('/getLogData-Open' , [App\Http\Controllers\ProductionOpen::class , 'getLogDataOpen']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-workorders']
],function(){
    Route::resource('/pd-work' , App\Http\Controllers\ProductionWorkOrder::class);
    Route::post('/getData-Work' , [App\Http\Controllers\ProductionWorkOrder::class , 'getDataWork']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-ladingorders']
],function(){
    Route::resource('/pd-ladi' , App\Http\Controllers\ProductionLadingOrder::class);
    Route::post('/getData-Ladi' , [App\Http\Controllers\ProductionLadingOrder::class , 'getDataLadi']);
    Route::post('/getProduct' , [App\Http\Controllers\ProductionLadingOrder::class , 'getProduct']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-returnorders']
],function(){
    Route::resource('/pd-retu' , App\Http\Controllers\ProductionReturnOrder::class);
    Route::post('/getData-Retu' , [App\Http\Controllers\ProductionReturnOrder::class , 'getDataRetu']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-requestorders']
],function(){
    Route::resource('/pd-requ' , App\Http\Controllers\ProductionRequestOrder::class);
    Route::post('/getData-Requ' , [App\Http\Controllers\ProductionRequestOrder::class , 'getDataRequ']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-workinghours']
],function(){
    Route::resource('/pd-woho' , App\Http\Controllers\ProductionWorkingHours::class);
    Route::post('/getData-Woho' , [App\Http\Controllers\ProductionWorkingHours::class , 'getDataWoho']);
    Route::post('/getEmployee' , [App\Http\Controllers\ProductionWorkingHours::class , 'getEmployee']);
    Route::post('/cancelDocsMan' , [App\Http\Controllers\ProductionWorkingHours::class , 'cancelDocsMan']);
    Route::get('/employee/jobs', [App\Http\Controllers\ProductionWorkingHours::class, 'getJobs'])->name('employee.jobs');
});
Route::group([
    'middleware' =>  ['auth','permission:docu-finalinspections']
],function(){
    Route::resource('/fl-inst' , App\Http\Controllers\FinalInspection::class);
    Route::post('/getData-Inst' , [App\Http\Controllers\FinalInspection::class , 'getDataInst']);
});
Route::group([
    'middleware' =>  ['auth','permission:docu-productionclosejobs']
],function(){
    Route::resource('/pd-close' , App\Http\Controllers\ProductionClose::class);
    Route::post('/getData-Close' , [App\Http\Controllers\ProductionClose::class , 'getDataClose']);
    Route::post('/getLogData-Close' , [App\Http\Controllers\ProductionClose::class , 'getLogDataClose']);
});
Route::group([
    'middleware' =>  ['auth','permission:Report-productionplan']
],function(){
    Route::resource('/pd-calendar' , App\Http\Controllers\ProductionCalendar::class);
    Route::post('/pd-calendar/getDataProductioncalendar' , [App\Http\Controllers\ProductionCalendar::class , 'getDataProductioncalendar']);
    Route::post('/pd-popup-calendar' , [App\Http\Controllers\ProductionCalendar::class , 'popupCalendar']);
    Route::post('/pd-calendar-filter' , [App\Http\Controllers\ProductionCalendar::class , 'filterCalendar']);
});
Route::group([
    'middleware' =>  ['auth','permission:Report-followupplan']
],function(){
    Route::resource('/pd-follow' , App\Http\Controllers\ProductionFollow::class);
});
Route::group([
    'middleware' =>  ['auth','permission:Report-manhours']
],function(){
    Route::resource('/mn-report' , App\Http\Controllers\ManhourReport::class);
    Route::post('/getData-ManHour' , [App\Http\Controllers\ManhourReport::class , 'getDataManHour']);
});
Route::group([
    'middleware' =>  ['auth','permission:Report-costmaterials']
],function(){
    Route::resource('/cm-report' , App\Http\Controllers\CostMaterialReport::class);
    Route::post('/getData-Cost' , [App\Http\Controllers\CostMaterialReport::class , 'getDataCost']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-ncr']
],function(){
    Route::resource('/ncr-report' , App\Http\Controllers\NcrReport::class);
    Route::post('/cancelDocsNcr' , [App\Http\Controllers\NcrReport::class , 'cancelDocsNcr']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-car']
],function(){
    Route::resource('/car-report' , App\Http\Controllers\CarReport::class);
    Route::post('/cancelDocsCar' , [App\Http\Controllers\CarReport::class , 'cancelDocsCar']);
});
Route::resource('/wh-stock' , App\Http\Controllers\WareHouseStock::class);
Route::resource('/fl-form' , App\Http\Controllers\FinalInspectionForm::class);
// ISO 30 //
Route::resource('/documents' , App\Http\Controllers\MainDocument::class);
Route::group([
    'middleware' =>  ['auth','permission:iso-assessrisk']
],function(){
    Route::resource('/assessrisk' , App\Http\Controllers\IsoAssessrisk::class);
    Route::post('/cancelAssessrisk' , [App\Http\Controllers\IsoAssessrisk::class , 'cancelAssessrisk']);
    Route::post('/approvedAssessrisk' , [App\Http\Controllers\IsoAssessrisk::class , 'approvedAssessrisk']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-assessrisk-swot']
],function(){
    Route::resource('/assessrisk-swot' , App\Http\Controllers\IsoAssessriskSwot::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-objective']
],function(){
    Route::resource('/objcctives' , App\Http\Controllers\IsoObjcctives::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-plan']
],function(){
    Route::resource('/iso-plan' , App\Http\Controllers\IsoPlan::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-maintenancerecords']
],function(){
    Route::resource('/maintenance-records' , App\Http\Controllers\IsoMaintenanceRecords::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-machinehistorys']
],function(){
    Route::resource('/machine-history' , App\Http\Controllers\IsoMachineHistory::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-computerhistorys']
],function(){
    Route::resource('/computer-history' , App\Http\Controllers\IsoComputerHistory::class);
    Route::get('/computer-history/{id}/popup', [App\Http\Controllers\IsoComputerHistory::class, 'popup']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-itmaintenance']
],function(){
    Route::resource('/computer-records' , App\Http\Controllers\IsoComputerRecords::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-emailregistration']
],function(){
    Route::resource('/email-registration' , App\Http\Controllers\IsoEmailRegistration::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-knowledgesurvey']
],function(){
    Route::resource('/knowledge-survey' , App\Http\Controllers\IsoKnowledgesurvey::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-knowledgerecord']
],function(){
    Route::resource('/knowledge-record' , App\Http\Controllers\IsoKnowledgerecord::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-knowledgetransfer']
],function(){
    Route::resource('/knowledge-transfer' , App\Http\Controllers\IsoKnowledgetransfer::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-knowledgeregister']
],function(){
    Route::resource('/knowledge-register' , App\Http\Controllers\IsoKnowledgeregister::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-documentcontrol']
],function(){
    Route::resource('/document-register' , App\Http\Controllers\IsoDocumentregister::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-documentdistribution']
],function(){
    Route::resource('/document-distribution' , App\Http\Controllers\IsoDocumentdistribution::class);
    Route::post('/cancelDistribution' , [App\Http\Controllers\IsoDocumentdistribution::class , 'cancelDistribution']);
    Route::post('/approvedDistribution' , [App\Http\Controllers\IsoDocumentdistribution::class , 'approvedDistribution']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-documentcorrection']
],function(){
    Route::resource('/document-correction' , App\Http\Controllers\IsoDocumentcorrection::class);
    Route::post('/cancelCorrection' , [App\Http\Controllers\IsoDocumentcorrection::class , 'cancelCorrection']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-documentdestruction']
],function(){
    Route::resource('/document-destruction' , App\Http\Controllers\IsoDocumentdestruction::class);
    Route::post('/cancelDestruction' , [App\Http\Controllers\IsoDocumentdestruction::class , 'cancelDestruction']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-externaldocument']
],function(){
    Route::resource('/document-external' , App\Http\Controllers\IsoDocumentexternal::class);
    Route::post('/cancelExternalHd' , [App\Http\Controllers\IsoDocumentexternal::class , 'cancelExternalHd']);
    Route::post('/cancelExternalDt' , [App\Http\Controllers\IsoDocumentexternal::class , 'cancelExternalDt']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-referencedocuments']
],function(){
    Route::resource('/document-reference' , App\Http\Controllers\IsoDocumentreference::class);
    Route::post('/cancelReference' , [App\Http\Controllers\IsoDocumentreference::class , 'cancelReference']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-designplan']
],function(){
    Route::resource('/design-plan' , App\Http\Controllers\IsoDesignPlan::class);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-designreview-a']
],function(){
    Route::resource('/design-review-a' , App\Http\Controllers\IsoDesignReviewA::class);
    Route::post('/cancelReviewAHd' , [App\Http\Controllers\IsoDesignReviewA::class , 'cancelReviewAHd']);
    Route::post('/cancelReviewADt' , [App\Http\Controllers\IsoDesignReviewA::class , 'cancelReviewADt']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-designreview-b']
],function(){
    Route::resource('/design-review-b' , App\Http\Controllers\IsoDesignReviewB::class);
    Route::post('/cancelReviewB' , [App\Http\Controllers\IsoDesignReviewB::class , 'cancelReviewB']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-detailedtesting']
],function(){
    Route::resource('/detailed-testing' , App\Http\Controllers\IsoDetailedTesting::class);
    Route::post('/cancelTesting' , [App\Http\Controllers\IsoDetailedTesting::class , 'cancelTesting']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-editdesign']
],function(){
    Route::resource('/design-edit' , App\Http\Controllers\IsoDesignEdit::class);
    Route::post('/cancelDesignedit' , [App\Http\Controllers\IsoDesignEdit::class , 'cancelDesignedit']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-productregistration']
],function(){
    Route::resource('/product-registration' , App\Http\Controllers\IsoProductRegistration::class);
    Route::post('/cancelRegistrationHd' , [App\Http\Controllers\IsoProductRegistration::class , 'cancelRegistrationHd']);
    Route::post('/cancelRegistrationDt' , [App\Http\Controllers\IsoProductRegistration::class , 'cancelRegistrationDt']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-qualityplan']
],function(){
    Route::resource('/quality-plan' , App\Http\Controllers\IsoQualityPlan::class);
    Route::post('/cancelQualityplanHd' , [App\Http\Controllers\IsoQualityPlan::class , 'cancelQualityplanHd']);
    Route::post('/cancelQualityplanDt' , [App\Http\Controllers\IsoQualityPlan::class , 'cancelQualityplanDt']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-productselection']
],function(){
    Route::resource('/product-selection' , App\Http\Controllers\IsoProductSelection::class);
    Route::post('/cancelProductSelectionHd' , [App\Http\Controllers\IsoProductSelection::class , 'cancelProductSelectionHd']);
    Route::post('/cancelProductSelectionDt' , [App\Http\Controllers\IsoProductSelection::class , 'cancelProductSelectionDt']);
    Route::post('/ApprovedProductSelectionHd' , [App\Http\Controllers\IsoProductSelection::class , 'ApprovedProductSelectionHd']);
    Route::post('/updateProductSelection' , [App\Http\Controllers\IsoProductSelection::class , 'updateProductSelection']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-recipientselection']
],function(){
    Route::resource('/recipient-selection' , App\Http\Controllers\IsoRecipientSelection::class);
    Route::post('/cancelRecipientSelection' , [App\Http\Controllers\IsoRecipientSelection::class , 'cancelRecipientSelection']);
    Route::post('/ApprovedRecipientSelection' , [App\Http\Controllers\IsoRecipientSelection::class , 'ApprovedRecipientSelection']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-selectedproduct']
],function(){
    Route::resource('/product-list-selected' , App\Http\Controllers\IsoProductListSelected::class);
    Route::post('/cancelProductListSelectedHd' , [App\Http\Controllers\IsoProductListSelected::class , 'cancelProductListSelectedHd']);
    Route::post('/cancelProductListSelectedDt' , [App\Http\Controllers\IsoProductListSelected::class , 'cancelProductListSelectedDt']);
});
Route::group([
    'middleware' =>  ['auth','permission:iso-softwaredesign']
],function(){
    Route::resource('/software-design' , App\Http\Controllers\IsoSoftwareDesign::class);
    Route::post('/cancelSoftwareDesignHd' , [App\Http\Controllers\IsoSoftwareDesign::class , 'cancelSoftwareDesignHd']);
    Route::post('/cancelSoftwareDesignDt' , [App\Http\Controllers\IsoSoftwareDesign::class , 'cancelSoftwareDesignDt']);
    Route::post('/approvedSoftwareDesign' , [App\Http\Controllers\IsoSoftwareDesign::class , 'approvedSoftwareDesign']);
});
// ISO 30 //