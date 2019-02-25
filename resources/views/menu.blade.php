 
<ul id="dropdown1" class="dropdown-content"> 
  <li><a href="/users/get" style="color:black">Usuário</a></li>
  <li class="divider"></li>
  <li><a href="/logout" style="color:black">Sair</a></li>
</ul>
 
<ul id="dropdown2" class="dropdown-content">
  <li><a href="/users/getall" style="color:black">Listar</a></li>
  <li><a href="/users/profile" style="color:black">Perfil</a></li>
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
  
  @yield('content')
   
  @yield('script-js')

  <script> 
      $( document ).ready(function() {
          M.AutoInit();
        
      });
      
  </script>