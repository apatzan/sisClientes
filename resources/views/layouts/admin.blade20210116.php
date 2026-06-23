<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GLB COLLECTIONS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('home')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>GLB COLLECTIONS</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>GLB COLLECTIONS</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <small class="bg-green">Conectado</small>
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                      Producción
                      <small>Version 1.2</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar Sesión</a>
                      <a href="{{URL::action('UsuarioController@edit',Auth::user()->id)}}" class="btn btn-default btn-flat">Mi Perfil</a>
                      
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            @can('isAdmin')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span>Gestión</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('gestion/tipificacion')}}"><i class="fa fa-circle-o"></i> Tipificación</a></li>
           <!--     <li><a href="gestion/tipificacion"><i class="fa fa-circle-o"></i> Consulta</a></li> -->
              </ul>
            </li>
            @endcan

          @can('isSupervisor')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-briefcase"></i>
                <span>Gestión</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('gestion/tipificacion')}}"><i class="fa fa-circle-o"></i> Tipificación</a></li>
           <!--     <li><a href="gestion/tipificacion"><i class="fa fa-circle-o"></i> Consulta</a></li> -->
              </ul>
            </li>
            @endcan  

            <li class="treeview">
              <a href="#">
                <i class="fa fa-male"></i>
                <span>clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              
                <li><a href="{{url('cliente/consulta')}}"><i class="fa fa-circle-o"></i> Mis Clientes</a></li>
                <li><a href="{{url('cliente/promesa')}}"><i class="fa fa-circle-o"></i> Promesas de Pago</a></li>
                <li><a href="{{url('pago/consulta')}}"><i class="fa fa-circle-o"></i>Pagos</a></li>
            
                <li><a href="{{url('cliente/general')}}"><i class="fa fa-circle-o"></i>Consulta General</a></li>            
              </ul>
            </li>
            
            @can('isAdmin')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Administración</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              
              <ul class="treeview-menu">
              
                <li><a href="{{url('seguridad/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="{{url('seguridad/perfil')}}"><i class="fa fa-circle-o"></i> Perfiles</a></li>
              </ul>
              
            </li>
            @endCan
                       
            @can('isAdmin')            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-adjust"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('reporte/dashboard')}}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                <li><a href="{{url('reporte/consulta')}}"><i class="fa fa-circle-o"></i> Gestiones Diarias</a></li>
                <li><a href="{{url('gestion/reportegeneral')}}"><i class="fa fa-circle-o"></i> Gestiones Acumuladas</a></li>
                <li><a href="{{url('reporte/cartera')}}"><i class="fa fa-circle-o"></i> Cartera al día</a></li>
                <li><a href="{{url('reporte/global')}}"><i class="fa fa-circle-o"></i> Reporte de Cuentas por estado</a></li>
              </ul>
            </li>
          @endcan

          @can('isSupervisor')            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-adjust"></i> <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('home')}}"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                <li><a href="{{url('reporte/consulta')}}"><i class="fa fa-circle-o"></i> Gestiones Diarias</a></li>
              </ul>
            </li>
          @endcan

          @can('isAdmin')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Cargas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('carga/saldos')}}"><i class="fa fa-circle-o"></i> Cargar Clientes</a></li>
                <li><a href="{{url('carga/pagos')}}"><i class="fa fa-circle-o"></i> Cargar Pagos</a></li>
				<li><a href="{{url('carga/asignacion')}}"><i class="fa fa-circle-o"></i> Asignar cuentas</a></li>
				<li><a href="{{url('/carga/desasignacion')}}"><i class="fa fa-circle-o"></i> Desasignar cuentas</a></li>	
			  </ul>
            </li>
           <li>
          @endcan 
          @can('isSupervisor')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Cargas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('carga/saldos')}}"><i class="fa fa-circle-o"></i> Cargar Clientes</a></li>
                <li><a href="{{url('carga/pagos')}}"><i class="fa fa-circle-o"></i> Cargar Pagos</a></li>
              </ul>
            </li>
           <li>
          @endcan 
         <!--
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">UMG</small>
              </a>
            </li> -->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Gestion de Clientes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
		                          <!--Contenido-->
                              @yield('contenido')
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <!--<div class="pull-right hidden-xs">{{ Auth::user()->name }} Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="www.google.com">UMG</a>.</strong> Todos los derechos reservados. -->
      </footer>

      @stack('scripts')  
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    @stack('scripts') 
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>
</html>
