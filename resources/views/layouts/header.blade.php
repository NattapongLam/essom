<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom-0 shadow-sm py-2">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="font-size: 1.2rem;"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">
      <!-- ปุ่มออกจากการระบบ (Logout) -->
      <li class="nav-item">
        <form action="{{route('logout')}}" method="POST" style="display: none;" id="form-logout">
          @csrf
        </form>
        <a class="nav-link text-danger" href="{{ route('login') }}" 
           onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
           title="ออกจากระบบ" style="font-size: 1.2rem;">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
      
      <!-- ปุ่มขยายเต็มจอ -->
      <li class="nav-item">       
        <a class="nav-link text-muted" data-widget="fullscreen" href="#" role="button" style="font-size: 1.1rem;">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown" id="notification-dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge" id="notification-count">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header" id="notification-header">0 การแจ้งเตือนใหม่</span>
          <div class="dropdown-divider"></div>
          
          <div id="notification-list">
            <!-- รายการแจ้งเตือนจะถูกแทรกเข้ามาตรงนี้ด้วย JavaScript -->
            <span class="dropdown-item text-center text-muted">กำลังโหลด...</span>
          </div>

          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">ดูการแจ้งเตือนทั้งหมด</a>
        </div>
      </li>
      <!-- ปุ่มเปลี่ยนรหัสผ่าน -->
      <li class="nav-item">
        <a class="nav-link text-secondary" data-toggle="modal" data-target="#changePasswordModal" href="#" title="เปลี่ยนรหัสผ่าน" style="font-size: 1.1rem;">
          <i class="fas fa-key"></i>
        </a>
      </li>          
    </ul>
</nav>
<!-- Modal เปลี่ยนรหัสผ่าน -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="form-change-password" action="{{ route('password.update') }}" method="POST">
        @csrf
        @method('PUT') <!-- หรือเปลี่ยนเป็น POST ตาม Route ที่คุณตั้งไว้ -->
        
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">เปลี่ยนรหัสผ่าน</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body">
          <!-- แสดงข้อความแจ้งเตือน Error (ถ้ามี) -->
          <div id="password-error-alert" class="alert alert-danger d-none"></div>
          
          <!-- รหัสผ่านปัจจุบัน -->
          <div class="form-group">
            <label for="current_password">รหัสผ่านปัจจุบัน</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
          </div>

          <!-- รหัสผ่านใหม่ -->
          <div class="form-group">
            <label for="password">รหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>

          <!-- ยืนยันรหัสผ่านใหม่ -->
          <div class="form-group">
            <label for="password_confirmation">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-primary" id="btn-save-password">บันทึกรหัสผ่าน</button>
        </div>
      </form>
    </div>
  </div>
</div>
@push('scriptjs')
<script>
$(document).ready(function() {
    function loadNotifications() {
        $.ajax({
            url: "{{ url('/api/notifications') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                let count = response.unreadCount;
                let notifications = response.notifications;

                // อัปเดตตัวเลขแจ้งเตือน
                if (count > 0) {
                    $('#notification-count').text(count).show();
                    $('#notification-header').text(count + ' การแจ้งเตือนใหม่');
                } else {
                    $('#notification-count').hide();
                    $('#notification-header').text('ไม่มีการแจ้งเตือนใหม่');
                }

                // เคลียร์รายการเดิมและสร้างรายการใหม่
                let listHtml = '';
                if (notifications.length > 0) {
                    $.each(notifications, function(index, item) {
                        // ปรับให้ตรงกับโครงสร้าง View ของคุณ (docutype / remark)
                        let title = item.docutype || 'แจ้งเตือนเอกสาร';
                        let remark = item.remark || '';
                        let url = item.url || '#'; // ถ้า View ไม่มี url จะเป็น #
                        let status = item.status || '';

                        listHtml += `
                            <a href="${url}" class="dropdown-item">
                                <i class="fas fa-file-alt mr-2 text-primary"></i> 
                                <span class="font-weight-bold">${title}</span><br>
                                <small class="text-muted text-wrap">${remark.substring(0, 40)}...</small>
                            </a>
                            <div class="dropdown-divider"></div>
                        `;
                    });
                } else {
                    listHtml = `<span class="dropdown-item text-center text-muted">ไม่มีการแจ้งเตือนใหม่</span>`;
                }

                $('#notification-list').html(listHtml);
            },
            error: function(xhr) {
                console.log("ไม่สามารถโหลดข้อมูลแจ้งเตือนได้");
            }
        });
    }

    // โหลดข้อมูลทันทีเมื่อเปิดหน้าเว็บ
    loadNotifications();

    // รีเฟรชข้อมูลทุกๆ 60 วินาที
    setInterval(loadNotifications, 60000);
});
// Script สำหรับจัดการฟอร์มเปลี่ยนรหัสผ่าน
$('#form-change-password').on('submit', function(e) {
    e.preventDefault();
    
    let form = $(this);
    let submitBtn = $('#btn-save-password');
    let errorAlert = $('#password-error-alert');
    
    submitBtn.prop('disabled', true).text('กำลังบันทึก...');
    errorAlert.addClass('d-none').html('');

    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
            submitBtn.prop('disabled', false).text('บันทึกรหัสผ่าน');
            $('#changePasswordModal').modal('hide');
            form[0].reset();
            
            // แจ้งเตือนเมื่อสำเร็จ (แนะนำให้ใช้ SweetAlert2 ถ้ามีในโปรเจกต์)
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: 'เปลี่ยนรหัสผ่านเรียบร้อยแล้ว',
                    timer: 2000,
                    showConfirmButton: false
                });
            } else {
                alert('เปลี่ยนรหัสผ่านเรียบร้อยแล้ว');
            }
        },
        error: function(xhr) {
            submitBtn.prop('disabled', false).text('บันทึกรหัสผ่าน');
            let errors = xhr.responseJSON.errors;
            let errorMessage = '';
            
            if (errors) {
                $.each(errors, function(key, value) {
                    errorMessage += value[0] + '<br>';
                });
            } else {
                errorMessage = xhr.responseJSON.message || 'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง';
            }
            
            errorAlert.html(errorMessage).removeClass('d-none');
        }
    });
});
</script>
@endpush