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
    </ul>
</nav>