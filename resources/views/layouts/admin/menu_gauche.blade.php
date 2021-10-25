<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <img src="{{ URL::asset('template/admin/dist/img/mestro.png') }}" alt="logo" class="brand-image img-circle elevation-3" style="opacity: .8">

      <span class="brand-text font-weight-light"> <?= config('app.name'); ?> </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ URL::asset('template/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}} <br>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                tableau de bord
                <!-- <span class="right badge badge-danger">New</span>Elephorm Formation Apprendre Ajax  JQuery -->
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('produits.index') }}" class="nav-link">
              <i class="fa fa-home"></i>
              <p>
               Produits
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('offres.index') }}" class="nav-link">
              <i class="fa fa-gear"></i>
              <p>
                Offres
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('strategie.create')}} " class="nav-link">
              <i class="fa fa-home"></i>
              <p>
               Strategie de prix
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('notifications.index')}}" class="nav-link">
              <i class="fa fa-home"></i>
              <p>
               Notifications
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-folder"></i>
              <p>
                Repositionnements
                 <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}


          <!-- <li class="nav-item has-treeview menu-open"> -->


          {{-- @endif --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
