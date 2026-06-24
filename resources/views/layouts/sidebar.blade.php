<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar px-3">
      <!-- Sidebar user panel -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
          <!-- ขยายขนาดโลโก้ในวงกลมให้ชัดขึ้น -->
          <img src="{{asset('img/logo-essom.png')}}" class="img-circle elevation-2" alt="Essom Logo" style="width: 40px; height: 40px; border: 2px solid rgba(255,255,255,0.2);">        
        </div>
        <div class="info pl-3">                    
            @auth
            <!-- แสดงชื่อผู้ใช้ด้วยฟอนต์หนาและสีที่สว่างเห็นชัดเจน -->
            <a href="#" class="d-block font-weight-bold text-white" style="font-size: 16px;">{{auth()->user()->name}}</a>    
            @else
            <a href="{{ route('login')}}" class="d-block font-weight-bold">เข้าสู่ระบบ (Login)</a>            
            @endauth
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
       
        <li class="nav-header">แบบบันทึก</li>
        @can('docu-productionnotices')
        <li class="nav-item">
            <a href="{{route('pd-noti.index')}}" class="nav-link {{\Request::routeIs('pd-noti.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-file-alt"></i>
                <p>ใบแจ้งผลิต</p>
            </a>           
        </li>
        @endcan 
        @can('docu-deliveryorders')
        <li class="nav-item">
            <a href="{{route('del-order.index')}}" class="nav-link {{\Request::routeIs('del-order.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-shipping-fast"></i>
                <p>ใบนำส่งสินค้า</p>
            </a>           
        </li>
        @endcan 
        @can('docu-productionopenjobs')
        <li class="nav-item">
            <a href="{{route('pd-open.index')}}" class="nav-link {{\Request::routeIs('pd-open.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>ใบเปิดงาน</p>
            </a>           
        </li>
        @endcan
        @can('docu-workorders')   
        <li class="nav-item">
            <a href="{{route('pd-work.index')}}" class="nav-link {{\Request::routeIs('pd-work.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-tasks"></i>
                <p>ใบสั่งงาน</p>
            </a>           
        </li>
        @endcan
        @can('docu-ladingorders')   
        <li class="nav-item">
            <a href="{{route('pd-ladi.index')}}" class="nav-link {{\Request::routeIs('pd-ladi.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-box-open"></i>
                <p>ใบเบิกวัสดุอุปกรณ์</p>
            </a>           
        </li>
        @endcan
        @can('docu-returnorders')   
        <li class="nav-item">
            <a href="{{route('pd-retu.index')}}" class="nav-link {{\Request::routeIs('pd-retu.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-undo-alt"></i>
                <p>รับคืนจากการเบิก</p>
            </a>           
        </li>
        @endcan 
        @can('docu-requestorders')   
        <li class="nav-item">
            <a href="{{route('pd-requ.index')}}" class="nav-link {{\Request::routeIs('pd-requ.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>ใบขอซื้อ</p>
            </a>           
        </li>
        @endcan
        @can('docu-workinghours')   
        <li class="nav-item">
            <a href="{{route('pd-woho.index')}}" class="nav-link  {{\Request::routeIs('pd-woho.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-clock"></i>
                <p>บันทึกชั่วโมงการทำงาน</p>
            </a>           
        </li>
        @endcan
        @can('docu-finalinspections')   
        <li class="nav-item">
            <a href="{{route('fl-inst.index')}}" class="nav-link {{\Request::routeIs('fl-inst.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-clipboard-check"></i>
                <p>ตรวจสอบขั้นตอนสุดท้าย</p>
            </a>           
        </li>
        @endcan
        @can('docu-productionclosejobs')   
        <li class="nav-item">
            <a href="{{route('pd-close.index')}}" class="nav-link {{\Request::routeIs('pd-close.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-folder"></i>
                <p>ใบปิดงาน</p>
            </a>           
        </li>
        @endcan                       
        
        <li class="nav-header">รายงาน</li>    
        @can('Report-productionplan')   
        <li class="nav-item">
            <a href="{{route('pd-calendar.index')}}" class="nav-link {{\Request::routeIs('pd-calendar.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <p>แผนการผลิต</p>
            </a>           
        </li>
        @endcan
        @can('Report-followupplan')
        <li class="nav-item">
            <a href="{{route('pd-follow.index')}}" class="nav-link {{\Request::routeIs('pd-follow.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-eye"></i>
                <p>ติดตามงาน</p>
            </a>           
        </li>
        @endcan
        @can('Report-manhours')
        <li class="nav-item">
            <a href="{{route('mn-report.index')}}" class="nav-link {{\Request::routeIs('mn-report.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>Man Hour Report</p>
            </a>           
        </li>
        @endcan
        @can('Report-costmaterials')
        <li class="nav-item">
            <a href="{{route('cm-report.index')}}" class="nav-link {{\Request::routeIs('cm-report.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-file-invoice-dollar"></i>
                <p>Cost of Material</p>
            </a>           
        </li>
        @endcan
        @can('main-iso')
        <li class="nav-header">ระบบคุณภาพ</li>
        <li class="nav-item">
            <a href="{{route('documents.index')}}" class="nav-link {{\Request::routeIs('documents.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-certificate"></i>
                <p>เอกสาร ISO</p>
            </a>           
        </li>
        @endcan
        @can('setup-users')
        <li class="nav-header">ตั้งค่า</li>
        <li class="nav-item">
            <a href="{{route('employee.list')}}" class="nav-link {{\Request::routeIs('employee.list') ? 'active' : ''}}">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>ผู้ใช้งานระบบ</p>
            </a>           
        </li>  
        @endcan     
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>