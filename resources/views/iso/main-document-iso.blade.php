@extends('layouts.main')
@section('content')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .search-indigo {
        border: 2px solid #e0e7ff;
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    .search-indigo:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.15);
    }
    .iso-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #eef2f6;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        min-height: 160px;
    }
    .iso-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(79, 70, 229, 0.1), 0 10px 10px -5px rgba(79, 70, 229, 0.04);
        border-color: #c7d2fe;
    }
    /* ใช้เฉดสี Indigo แตกต่างกันไปตามประเภทของเอกสารเพื่อให้อ่านง่าย */
    .bg-indigo-1 { background: linear-gradient(135deg, #6366f1, #4f46e5); color: #ffffff; }
    .bg-indigo-2 { background: linear-gradient(135deg, #818cf8, #6366f1); color: #ffffff; }
    .bg-indigo-3 { background: linear-gradient(135deg, #4f46e5, #4338ca); color: #ffffff; }
    .bg-indigo-4 { background: linear-gradient(135deg, #3730a3, #312e81); color: #ffffff; }

    .iso-card .inner {
        padding: 24px 20px;
        position: relative;
        z-index: 2;
    }
    .iso-card h6 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 8px;
        letter-spacing: 0.3px;
    }
    .iso-card p {
        font-size: 0.85rem;
        opacity: 0.85;
        margin-bottom: 0;
        font-weight: 500;
    }
    .iso-card .icon {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 4.5rem;
        opacity: 0.12;
        transition: all 0.3s ease;
        z-index: 1;
    }
    .iso-card:hover .icon {
        transform: scale(1.1) rotate(-5px);
        opacity: 0.18;
    }
    .iso-card-footer {
        background: rgba(0, 0, 0, 0.15);
        color: rgba(255, 255, 255, 0.9);
        padding: 10px;
        text-align: center;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none !important;
        transition: background 0.2s ease;
        z-index: 2;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }
    .iso-card-footer:hover {
        background: rgba(0, 0, 0, 0.25);
        color: #ffffff;
    }
</style>

<div class="container-fluid mt-4">
    <div class="row">  
        <div class="col-12">
            <div class="card shadow-none border-0 bg-transparent">
                <div class="card-header bg-transparent border-0 px-0">
                    <div class="row align-items-center row-gap-3">
                        <div class="col-md-8">
                            <h3 class="m-0" style="font-weight: 800; color: #1e1b4b;">
                                <i class="fa fa-folder-open text-indigo-600 me-2" style="color: #4f46e5;"></i> เอกสาร ISO
                            </h3>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" id="searchBox" class="form-control search-indigo py-2-5 px-3" placeholder="ค้นหาเอกสาร เช่น NCR, F7132, Quality..." />
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row g-4 iso-boxes mt-2">
                    @can('iso-ncr') 
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>เอกสาร NCR</h6>
                                <p>F8700.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-alt"></i>
                            </div>
                            <a href="{{route('ncr-report.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan    

                    @can('iso-car') 
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>เอกสาร CAR</h6>
                                <p>F10200.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-line"></i>
                            </div>
                            <a href="{{route('car-report.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan  

                    @can('iso-assessrisk') 
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>ประเมินความเสี่ยง</h6>
                                <p>F6120.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-exclamation-triangle"></i>
                            </div>
                            <a href="{{route('assessrisk.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-assessrisk-swot') 
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>ประเมินความเสี่ยง SWOT</h6>
                                <p>F6120.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-pie"></i>
                            </div>
                            <a href="{{route('assessrisk-swot.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-objective') 
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>Objective</h6>
                                <p>F6200.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-target"></i>
                            </div>
                            <a href="{{route('objcctives.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-plan')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>Plan</h6>
                                <p>F6200.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar-alt"></i>
                            </div>
                            <a href="{{route('iso-plan.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-maintenancerecords')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>บันทึกบำรุงรักษาเครื่องจักร</h6>
                                <p>F7132.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-tools"></i>
                            </div>
                            <a href="{{route('maintenance-records.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-machinehistorys')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>ประวัติเครื่องจักร</h6>
                                <p>F7132.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-history"></i>
                            </div>
                            <a href="{{route('machine-history.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan 

                    @can('iso-computerhistorys')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>ประวัติคอมพิวเตอร์</h6>
                                <p>F7134.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <a href="{{route('computer-history.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-itmaintenance')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>บันทึกการบำรุงรักษา IT</h6>
                                <p>F7134.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-wrench"></i>
                            </div>
                            <a href="{{route('computer-records.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-emailregistration')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>ทะเบียน Email</h6>
                                <p>F7134.6</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <a href="{{route('email-registration.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-knowledgesurvey')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>แบบสำรวจความรู้องค์กร</h6>
                                <p>F7160.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-poll-h"></i>
                            </div>
                            <a href="{{route('knowledge-survey.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-knowledgerecord')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>บันทึกความรู้องค์กร</h6>
                                <p>F7160.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="{{route('knowledge-record.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-knowledgetransfer')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>ใบส่งต่อความรู้องค์กร</h6>
                                <p>F7160.3</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-exchange-alt"></i>
                            </div>
                            <a href="{{route('knowledge-transfer.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-knowledgeregister')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>ทะเบียนความรู้องค์กร</h6>
                                <p>F7160.4</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-id-card"></i>
                            </div>
                            <a href="{{route('knowledge-register.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-documentcontrol')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>ทะเบียนควบคุมเอกสาร</h6>
                                <p>F7530.1 (Master List)</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-folder-minus"></i>
                            </div>
                            <a href="{{route('document-register.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-documentdistribution')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>ทะเบียนแจกจ่ายเอกสาร</h6>
                                <p>F7530.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-share-square"></i>
                            </div>
                            <a href="{{route('document-distribution.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-documentcorrection')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>ใบคำขอแก้ไขเอกสาร</h6>
                                <p>F7530.3</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-edit"></i>
                            </div>
                            <a href="{{route('document-correction.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-documentdestruction')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>ใบขอทำลายเอกสาร</h6>
                                <p>F7530.4</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-trash-alt"></i>
                            </div>
                            <a href="{{route('document-destruction.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-externaldocument')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>ทะเบียนรับเข้าเอกสารภายนอก</h6>
                                <p>F7531.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-file-import"></i>
                            </div>
                            <a href="{{route('document-external.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-referencedocuments')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>ทะเบียนเอกสารอ้างอิง</h6>
                                <p>F7531.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bookmark"></i>
                            </div>
                            <a href="{{route('document-reference.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-designplan')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>แผนการออกแบบ</h6>
                                <p>F8300.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-drafting-compass"></i>
                            </div>
                            <a href="{{route('design-plan.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-designreview-a')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>การทบทวนการออกแบบ</h6>
                                <p>F8300.2A</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                            <a href="{{route('design-review-a.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-designreview-b')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>การทบทวนการออกแบบ</h6>
                                <p>F8300.2B</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-clipboard-check"></i>
                            </div>
                            <a href="{{route('design-review-b.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-detailedtesting')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>การทดสอบโดยละเอียด</h6>
                                <p>F8300.3</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-vial"></i>
                            </div>
                            <a href="{{route('detailed-testing.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-editdesign')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>คำขอแก้ไขแบบ</h6>
                                <p>F8300.4</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-pencil-ruler"></i>
                            </div>
                            <a href="{{route('design-edit.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-productregistration')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>ทะเบียนแบบผลิตภัณฑ์</h6>
                                <p>F8300.7</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-boxes"></i>
                            </div>
                            <a href="{{route('product-registration.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-qualityplan')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>Quality Plan</h6>
                                <p>F8510.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shield-alt"></i>
                            </div>
                            <a href="{{route('quality-plan.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-productselection')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-1">
                            <div class="inner text-center">
                                <h6>ใบคัดเลือกสินค้า</h6>
                                <p>F8411.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check-double"></i>
                            </div>
                            <a href="{{route('product-selection.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-recipientselection')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-2">
                            <div class="inner text-center">
                                <h6>ใบคัดเลือกผู้รับช่วง</h6>
                                <p>F8411.2</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-check"></i>
                            </div>
                            <a href="{{route('recipient-selection.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-selectedproduct')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-3">
                            <div class="inner text-center">
                                <h6>บัญชีรายชื่อสินค้า คัดเลือกแล้ว</h6>
                                <p>F8411.3</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <a href="{{route('product-list-selected.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan

                    @can('iso-softwaredesign')
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="iso-card bg-indigo-4">
                            <div class="inner text-center">
                                <h6>การออกแบบซอฟท์แวร์</h6>
                                <p>FS8302.1</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-code"></i>
                            </div>
                            <a href="{{route('software-design.index')}}" class="iso-card-footer" target="_blank" rel="noopener noreferrer">เข้าสู่ระบบ <i class="fa fa-arrow-circle-right ms-1"></i></a>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scriptjs')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
document.getElementById('searchBox').addEventListener('keyup', function() {
  const keyword = this.value.toLowerCase();
  // อัปเดต Selector ตัวชี้เป้าให้ตรงกับคลาสการ์ดและ Grid ใหม่ (.iso-boxes [class*="col-"])
  const boxes = document.querySelectorAll('.iso-boxes [class*="col-"]');

  boxes.forEach(box => {
    const text = box.innerText.toLowerCase();
    box.style.display = text.includes(keyword) ? '' : 'none';
  });
});
</script>
@endpush