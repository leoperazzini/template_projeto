 
@include('dependencies')  
 
<html lang="br"><head> 
  <title>
    Template Projeto
  </title>
 
<body class="login-page sidebar-collapse"> 
  <div class="page-header header-filter" style="background-color: purple; background-size: cover; background-position: top center;">

        @include('message') 

    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto">
          <div class="card card-login">
            <form method="POST" action="/login" id="form" class="form">
                @csrf
              <div class="card-header card-header-primary text-center">
                <h4 class="card-title">Login</h4> 
              </div>
              <p class="description text-center"></p>
              <div class="card-body">
                <span class="bmd-form-group"><div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">mail</i>
                    </span>
                  </div>
                  <input style="width: 80%" type  = "email" name  = "email" class = "form-control" placeholder = "E-mail" value = "@php if(isset($data['email'])){ echo $data['email'];} @endphp" />
                    @php if(isset($errors['email'][0])){ $erros_email_span = '<span style="width: 20%"></span><span style="color:red;">'.$errors['email'][0].'</span>'; }else{$erros_email_span = '' ;}@endphp 
                    @php echo $erros_email_span; @endphp
                </div>
                  
                </span>
               
                <br>
                <span class="bmd-form-group"><div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input style="width: 80%" name  = "password" type  = "password" class = "form-control" placeholder = "Senha" value = "@php if(isset($data['password'])){ echo $data['password'];} @endphp" />
                  @php if(isset($errors['password'][0])){ $erros_password_span = '<span style="width: 20%"></span><span style="color:red;">'.$errors['password'][0].'</span>'; }else{$erros_password_span = '' ;}@endphp 
                  @php echo $erros_password_span; @endphp
                </div></span>

                <span class="bmd-form-group">
                    <div class="input-group"> 
                        @php if(isset($errors['login_failed'])){ $erros_login_failed_span = '<span style="width: 20%"></span><span style="color:red;">'.$errors['login_failed'].'</span>'; }else{$erros_login_failed_span = '' ;}@endphp 
                        @php echo $erros_login_failed_span; @endphp
                        @php if(isset($errors['server_failed'])){ $erros_server_failed_span = '<span style="width: 20%"></span><span style="color:red;">'.$errors['server_failed'].'</span>'; }else{$erros_server_failed_span = '' ;}@endphp 
                        @php echo $erros_server_failed_span; @endphp 
                    </div>
                </span>
             
              </div>

             
                    
              <div class="footer text-center">
                <a href="#" onClick="document.getElementById('form').submit();" class="btn btn-primary btn-link btn-wd btn-lg">Entrar</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container"> 
     
      </div>
    </footer>
  </div> 

</body></html>
