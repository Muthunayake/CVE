<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Vulnerability Manager</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block text-capitalize">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link @if($page=='dashboard') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('scan.data')}}" class="nav-link @if($page=='scan-data') active @endif"">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Scan Data
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('cve')}}" class="nav-link @if($page=='cve') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                CVE
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('exp')}}" class="nav-link @if($page=='exp') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Exploit
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('asset.lists')}}" class="nav-link @if($page=='asset-list') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Asset List
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('current-control')}}" class="nav-link @if($page=='current-control') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                SafeGuards 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('upload')}}" class="nav-link @if($page=='upload') active @endif">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Upload 
              </p>
            </a>
          </li>
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Report 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle nav-icon"></i>
                  <p>Report 2</p>
                </a>
              </li>
            </ul>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>