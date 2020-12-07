
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
      <img src="dist/img/icon-72x72.png" alt="Admin Maipo Grande" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin|Maipo Grande</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas "></i>
              <p>
                Menu inicio
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <!--
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuario</p>
                </a>
              </li>
              -->
              <!--
              <li class="nav-item">
                <a class="nav-link" href="{{url('categoria')}}" onclick="event.preventDefault(); document.getElementById('categoria-form').submit();"><i class="fa fa-list"></i> Categorías</a>
                  <form id="categoria-form" action="{{url('categoria')}}" method="GET" style="display: none;">
                  {{csrf_field()}} 
                  </form>
              </li>
              -->     
              
              <li class="nav-item">
                <a class="nav-link" href="{{url('producto')}}"  ><i class="fa fa-cart-plus"></i> Productos</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{url('usuario')}}" ><i class="fa fa-users"></i> Usuarios</a>
              </li>
              <!--
              <li class="nav-item">
                  <a class="nav-link" href="{{url('cliente')}}" ><i class="fa fa-users"></i> Clientes</a>
              </li>
              -->
              <li class="nav-item">
                  <a class="nav-link" href="{{url('ModificarContratos')}}" ><i class="fa fa-docs"></i> Contratos</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{url('VentasExternas')}}" ><i class="fa fa-docs"></i> Pedidos internacionales</a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
