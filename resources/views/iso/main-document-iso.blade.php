@extends('layouts.main')
@section('content')
<!-- Sweet Alert-->
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<div class="mt-4"><br>
<div class="row">  
    <div class="col-12">
        <div class="card">
          <div class="card-header">
                <div class="row">
                    <h3 class="card-title" style="font-weight: bold">เอกสาร ISO</h3>
                    <div class="col-md-4">
                      <input type="text" id="searchBox" class="form-control" placeholder="🔍 ค้นหาเอกสาร เช่น NCR, F7132, Quality..." />
                    </div>
                </div>
                <br>      
      <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>เอกสาร NCR</strong></h6>
              <p>F8700.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('ncr-report.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>เอกสาร CAR</strong></h6>
               <p>F10200.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('car-report.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>ประเมินความเสี่ยง</strong></h6>
              <p>F6120.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('assessrisk.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>ประเมินความเสี่ยง SWOT</strong></h6>
              <p>F6120.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('assessrisk-swot.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row iso-boxes">
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>Objective</strong></h6>
              <p>F6200.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('objcctives.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>Plan</strong></h6>
               <p>F6200.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('iso-plan.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>บันทึกบำรุงรักษาเครื่องจักร</strong></h6>
              <p>F7132.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('maintenance-records.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>ประวัติเครื่องจักร</strong></h6>
              <p>F7132.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('machine-history.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>ประวัติคอมพิวเตอร์</strong></h6>
              <p>F7134.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('computer-history.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>บันทึกการบำรุงรักษา IT</strong></h6>
               <p>F7134.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('computer-records.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>ทะเบียน Email</strong></h6>
              <p>F7134.6</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('email-registration.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>แบบสำรวจความรู้องค์กร</strong></h6>
              <p>F7160.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('knowledge-survey.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>บันทึกความรู้องค์กร</strong></h6>
              <p>F7160.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('knowledge-record.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>ใบส่งต่อความรู้องค์กร</strong></h6>
               <p>F7160.3</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('knowledge-transfer.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>ทะเบียนความรู้องค์กร</strong></h6>
              <p>F7160.4</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('knowledge-register.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>ทะเบียนควบคุมเอกสาร</strong></h6>
              <p>F7530.1 (Master List)</p>              
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('document-register.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>ทะเบียนแจกจ่ายเอกสาร</strong></h6>
              <p>F7530.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('document-distribution.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>ใบคำขอแก้ไขเอกสาร</strong></h6>
               <p>F7530.3</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('document-correction.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>ใบขอทำลายเอกสาร</strong></h6>
              <p>F7530.4</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('document-destruction.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>ทะเบียนรับเข้าเอกสารภายนอก</strong></h6>
              <p>F7531.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('document-external.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
     <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>ทะเบียนเอกสารอ้างอิง</strong></h6>
              <p>F7531.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('document-reference.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>แผนการออกแบบ</strong></h6>
               <p>F8300.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('design-plan.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>การทบทวนการออกแบบ</strong></h6>
              <p>F8300.2A</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('design-review-a.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>การทบทวนการออกแบบ</strong></h6>
              <p>F8300.2B</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('design-review-b.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>การทดสอบโดยละเอียด</strong></h6>
              <p>F8300.3</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('detailed-testing.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>คำขอแก้ไขแบบ</strong></h6>
               <p>F8300.4</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('design-edit.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>ทะเบียนแบบผลิตภัณฑ์</strong></h6>
              <p>F8300.7</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('product-registration.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>Quality Plan</strong></h6>
              <p>F8510.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('quality-plan.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
     <div class="row iso-boxes">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner text-center">
              <h6><strong>ใบคัดเลือกสินค้า</strong></h6>
              <p>F8411.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('product-selection.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner text-center">
               <h6><strong>ใบคัดเลือกผู้รับช่วง</strong></h6>
               <p>F8411.2</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('recipient-selection.index')}}" class="small-box-footer"  target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner text-center">
              <h6><strong>บัญชีรายชื่อสินค้า คัดเลือกแล้ว</strong></h6>
              <p>F8411.3</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('product-list-selected.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner  text-center">
             <h6><strong>การออกแบบซอฟท์แวร์</strong></h6>
              <p>FS8302.1</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('software-design.index')}}" class="small-box-footer" target="_blank" rel="noopener noreferrer">คลิก <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      </div>
    </div>
</div>
</div>
</div>   
@endsection
@push('scriptjs')
<!-- Sweet Alerts js -->
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
document.getElementById('searchBox').addEventListener('keyup', function() {
  const keyword = this.value.toLowerCase();
  const boxes = document.querySelectorAll('.iso-boxes .col-lg-3');

  boxes.forEach(box => {
    const text = box.innerText.toLowerCase();
    box.style.display = text.includes(keyword) ? '' : 'none';
  });
});
</script>
@endpush  