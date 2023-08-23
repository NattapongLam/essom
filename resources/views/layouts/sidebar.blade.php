<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('img/logo-essom.png')}}" class="img-circle" alt="User Image">        
        </div>
        <div class="info">                     
            @auth
            <a href="#" class="d-block" onclick="event.preventDefault(); document.getElementById('form-logout').submit();">{{auth()->user()->name}}</a>    
            <form action="{{route('logout')}}" method="POST" style="display: none;" id="form-logout">
                @csrf
            </form>        
            @else
            <a href="{{ route('login')}}" class="d-block">Login</a>            
            @endauth
         
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
        <li class="nav-header">แบบบันทึก</li>
        <li class="nav-item">
            <a href="{{route('pd-noti.index')}}" class="nav-link {{\Request::routeIs('pd-noti.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบแจ้งผลิต</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('del-order.index')}}" class="nav-link {{\Request::routeIs('del-order.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบนำส่งสินค้า</p>
            </a>           
        </li> 
        <li class="nav-item">
            <a href="{{route('pd-open.index')}}" class="nav-link {{\Request::routeIs('pd-open.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบเปิดงาน</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('pd-work.index')}}" class="nav-link {{\Request::routeIs('pd-work.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบสั่งงาน</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('pd-ladi.index')}}" class="nav-link {{\Request::routeIs('pd-ladi.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบเบิกวัสดุอุปกรณ์</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('pd-retu.index')}}" class="nav-link {{\Request::routeIs('pd-retu.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>รับคืนจากการเบิก</p>
            </a>           
        </li> 
        <li class="nav-item">
            <a href="{{route('pd-requ.index')}}" class="nav-link {{\Request::routeIs('pd-requ.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบขอซื้อ</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('pd-woho.index')}}" class="nav-link  {{\Request::routeIs('pd-woho.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>บันทึกชั่วโมงการทำงาน</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="{{route('fl-inst.index')}}" class="nav-link {{\Request::routeIs('fl-inst.index') ? 'active' : ''}}">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ตรวจสอบขั้นตอนสุดท้าย</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-pencil-alt"></i>
                <p>ใบปิดงาน</p>
            </a>           
        </li>                
        <li class="nav-header">รายงาน</li>       
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>แผนการผลิต</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>ติดตามงาน</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>สต็อคคงเหลือ</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Man Hour Report</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>Cost of Material</p>
            </a>           
        </li>
        <li class="nav-header">ระบบคุณภาพ</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>เอกสาร NCR</p>
            </a>           
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-bullhorn"></i>
                <p>เอกสาร CAR</p>
            </a>           
        </li>
        <li class="nav-header">ตั้งค่า</li>
        <li class="nav-item">
            <a href="{{route('employee.list')}}" class="nav-link {{\Request::routeIs('employee.list') ? 'active' : ''}}">
                <i class="nav-icon fas fa-users"></i>
                <p>ผู้ใช้งานระบบ</p>
            </a>           
        </li>       
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>