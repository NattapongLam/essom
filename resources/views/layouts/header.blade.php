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
    </ul>
</nav>
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
</script>
@endpush