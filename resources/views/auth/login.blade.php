  

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@include('message') 
  
<!------ Include the above in your HEAD tag ---------->
<form method="POST" action="/login">
    @csrf

            <div class = "container login-container">
                <div class = "row">
                    <div class = "col-md-1  ">
                    </div>
                    <div class = "col-md-10 login-form-1">

                           

                                <div  style="text-align:center;">
                                    <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
                                    <h3>Tela de Autenticação</h3>
                                </div> 
                            
                                <div   class = "form-group">
                                <input type  = "email" name  = "email" class = "form-control" placeholder = "E-mail" value = "@php if(isset($email)){ echo $email;} @endphp" />
                                </div>
                                <div   class = "form-group">
                                <input name  = "password" type  = "password" class = "form-control" placeholder = "Senha" value = "@php if(isset($password)){ echo $password;} @endphp" />
                                </div>
                                <div   class = "form-group">
                                <input type  = "submit" class = "btnSubmit" value = "Entrar" />
                                </div>
                                <div class = "form-group">
                                <a   href  = "#" class = "btnForgetPwd">Esqueceu sua senha?</a>
                                </div> 
                         
                    </div>
                </div>
            </div>

</form> 
 
<link href="/css/login.css" rel="stylesheet"/> 