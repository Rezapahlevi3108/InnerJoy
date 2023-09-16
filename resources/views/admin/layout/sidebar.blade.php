  <!-- Sidebar-->
  <div class="border-end bg-white innerjoyMain" id="sidebar-wrapper">
    <div class="sidebar-heading borderBottomColor text-white text-center fredoka display-2">InnerJoy</div>
    <div class="list-group list-group-flush ">
      <a class="list-group-item list-group-item-action border border-0 sideBarHover list-group-item-light p-3  text-white {{ Request::is('admin/dashboard*')? 'custom-active':'innerjoyMain'}}" href="{{ route('admin.dashboard') }}">
        <i class="fa-solid fa-house me-3" style="color: #ffffff;"></i>
        Dashboard
      </a>
      <a class="list-group-item list-group-item-action border border-0 sideBarHover list-group-item-light p-3  text-white {{ Request::is('admin/admin*')? 'custom-active':'innerjoyMain'}}" href="{{ route('admin.admin') }}">
        <i class="fa-solid fa-users me-3" style="color: #ffffff;"></i>  
        Kelola Admin
      </a>
      <a class="list-group-item list-group-item-action border border-0 sideBarHover list-group-item-light p-3  text-white {{ Request::is('admin/user*')? 'custom-active':'innerjoyMain'}}" href="{{ route('admin.user') }}">
        <i class="fa-solid fa-user me-3" style="color: #ffffff;"></i>  
        Kelola Pengguna
      </a>
      <a class="list-group-item list-group-item-action border border-0 sideBarHover list-group-item-light p-3  text-white {{ Request::is('admin/posting*')? 'custom-active':'innerjoyMain'}}" href="{{ route('admin.posting') }}">
        <i class="fa-solid fa-paper-plane me-3" style="color: #ffffff;"></i>  
        Kelola Posting
      </a>
    </div>
</div>