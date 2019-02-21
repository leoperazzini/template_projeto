  

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@include('message') 
  
<!------ Include the above in your HEAD tag ---------->
<form method="POST" action="/users/store">
    @csrf

             
    <div class = "row">
        <div class = "col-md-10 login-form-1">
            <div   class = "form-group">
                <input  name = "first_name" class = "form-control" placeholder = "Nome" value = "@php if(isset($data['first_name'])){ echo $data['first_name'];} @endphp" />
            </div>

            <div   class = "form-group">
                <input  name = "last_name" class = "form-control" placeholder = "Sobrenome" value = "@php if(isset($data['last_name'])){ echo $data['last_name'];} @endphp" />
            </div>

            <div   class = "form-group">
                <input type  = "email" name  = "email" class = "form-control" placeholder = "E-mail" value = "@php if(isset($data['email'])){ echo $data['email'];} @endphp" />
            </div>

            <div   class = "form-group">
                <input  name  = "date_birth" class = "form-control" placeholder = "Data de Nascimento" value = "@php if(isset($data['date_birth'])){ echo $data['date_birth'];} @endphp" />
            </div> 

            <div   class = "form-group">
                <input name  = "password" type  = "password" class = "form-control" placeholder = "Senha" value = "@php if(isset($data['password'])){ echo $data['password'];} @endphp" />
            </div>

            <div   class = "form-group">
                <input type  = "submit" class = "btnSubmit" value = "Cadastrar" />
            </div>

            <div class = "form-group">
                <a   href  = "#" class= "btnForgetPwd">Esqueceu sua senha?</a>
            </div>     
        </div>
    </div>
            

</form> 
 
<link href="/css/login.css" rel="stylesheet"/> 