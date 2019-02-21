 
<ul id="dropdown1" class="dropdown-content"> 
  <li><a href="/users/get">Usuário</a></li>
  <li class="divider"></li>
  <li><a href="/logout">Sair</a></li>
</ul>
 
<ul id="dropdown2" class="dropdown-content">
  <li><a href="/users/getall">Listar</a></li>
  <li><a href="/users/profile">Perfil</a></li>
</ul>

<nav>
  <div class="nav-wrapper black">
    <a href="/home" class="brand-logo">Empresa</a>
  
    <ul class="right hide-on-med-and-down">
      <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Usuários<i class="material-icons right">arrow_drop_down</i></a></li> 
       
      <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons right">account_circle</i></a></li>
    </ul>
  </div>
</nav>
  

  {{-- <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="/home"><h2>Empresa</h2></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    
    </button>

    <!-- Navbar Search -->
     
    <div class="input-group" style="color:white; text-align: center">
        <div class="col-sm-2"  >
        
        </div>
        <div class="col-sm-6"  >
            <h2> @yield('title')</h2>
        </div> 
    </div> 

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0"> 
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle" style="color:white"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Perfil</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/logout" data-toggle="modal">Sair</a>
        </div>
      </li>
    </ul>

  </nav> --}}
{{-- 
  <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-cogs"></i>
              <span>Configurações</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
              <h5 class="dropdown-header"><b> <i class="fa fa-users"></i> Usuários</b></h5>
              <a class="dropdown-item" href="/users/getall">Listar</a>
              <a class="dropdown-item" href="/users/profile">Perfil</a> 
              <div class="dropdown-divider"></div>
              <h6 class="dropdown-header">Other Pages:</h6>
              <a class="dropdown-item" href="404.html">404 Page</a>
              <a class="dropdown-item" href="blank.html">Blank Page</a>
            </div>
          </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">
          @yield('active')
   
          @yield('content')   
          
        </div>
      
      </div> 

  </div> --}}
  <!-- /#wrapper -->
  @yield('script-js')

  <script> 
      $( document ).ready(function() {
          M.AutoInit();
        
      });
      
  </script>