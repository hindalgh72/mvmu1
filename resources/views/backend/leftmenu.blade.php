<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.createrole')}}"><i class="fa fa-circle-o"></i>Create Role</a></li>
            <li><a href="{{route('user.createuser')}}"><i class="fa fa-circle-o"></i>Create User</a></li>
            <li><a href="{{route('user.editget')}}"><i class="fa fa-circle-o"></i>Edit User</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Notice</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('notice.createnotice')}}"><i class="fa fa-circle-o"></i>Create Notice</a></li>
            <li><a href="{{route('notice.editnotice')}}"><i class="fa fa-circle-o"></i>Edit Notice</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>