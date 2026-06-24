<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','ESSOM')</title>

  <!-- Google Font: เพิ่ม Sarabun สำหรับภาษาไทยสไตล์โมเดิร์นและ Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sarabun:300,400,500,600,700|Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
  @livewireStyles

  <style>
    /* ปรับฟอนต์ทั้งระบบให้ใหญ่ ชัดเจน และอ่านง่ายขึ้น */
    body {
      font-family: 'Sarabun', 'Source Sans Pro', sans-serif;
      font-size: 15px;
      background-color: #f8fafc;
    }
    /* เพิ่มมิติให้ Sidebar และเมนูเวลากด Active */
    .main-sidebar {
      background-color: #1e293b !important; /* สีน้ำเงินเข้มสไตล์ Slate Modern */
    }
    .nav-sidebar .nav-link.active {
      background-color: #4f46e5 !important; /* สี Indigo แมตช์กับหน้าล็อกอิน */
      box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3) !important;
      font-weight: 600;
    }
    .user-panel img {
      object-fit: contain;
      background: white;
      padding: 2px;
    }
    /* ปรับขนาดตัวอักษรของหัวข้อเมนู (Header) */
    .nav-header {
      font-size: 0.85rem !important;
      font-weight: 700 !important;
      letter-spacing: 0.5px;
      color: #94a3b8 !important;
      padding: 12px 16px 4px !important;
    }
    /* ขยายขนาดตัวหนังสือในเมนู Sidebar */
    .nav-sidebar .nav-link p {
      font-size: 15.5px;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content pt-4">
      <div class="container-fluid">
        @yield('content')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('layouts.footer')
</div>
<!-- ./wrapper -->

<div class="rightbar-overlay"></div>       
<!-- REQUIRED SCRIPTS -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  window.addEventListener('swal',function(e){
    Swal.fire({
      title: e.detail.title,
      timer: e.detail.timer,
      icon: e.detail.icon
    }).then(function(){
      if(e.detail.url){
        window.location = e.detail.url;
      }
    })
  })
  window.livewire.on("modalHide",() => {
    $("#modal").modal("hide");
  })
</script>
@stack('scriptjs')
</body>
</html>