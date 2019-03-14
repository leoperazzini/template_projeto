<head>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.css">
    <link rel="canonical" href="https://www.creative-tim.com/product/material-kit">
    <link href="/css/material-kit.css?v=2.0.5" rel="stylesheet"> 
    <link href="/demo/demo.css" rel="stylesheet">

                
  <script src="/js/core/jquery.js" type="text/javascript"></script>
  <script src="/js/core/popper.js" type="text/javascript"></script> 

   
      <script src="/js/core/bootstrap-material-design.js" type="text/javascript"></script>
      <script src="/js/plugins/moment.js"></script> 
      <script src="/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script> 
      <script src="/js/plugins/nouislider.js" type="text/javascript"></script>  
      <script src="/js/plugins/jquery.sharrre.js" type="text/javascript"></script> 
      <script src="/js/material-kit.js?v=2.0.5" type="text/javascript"></script>
</head> 
<html lang="br">
<title>
  Template Projeto
</title>

<body class="login-page sidebar-collapse"> 

@php //echo phpinfo(); @endphp


<div class="page-header header-filter" style="background-color: purple; background-size: cover; background-position: top center;">


  <div class="container"> 
    <div class="row"> 
      <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <div class="card card-login">
          <form method="POST" action="/forgotmypassword" id="form" class="form">
              @csrf
            <div class="card-header card-header-primary text-center">
              <h4 class="card-title">Esqueci minha senha</h4> 
            </div>
            <p class="description text-center"></p>
            <div class="card-body">
 
            <center>
              <span style="font-style: italic">
                 Será enviado uma mensagem para o e-mail abaixo .
              </span>
            </center>
            

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
              
              <span class="bmd-form-group">
                  <div class="input-group"> 
                     @php if(isset($message['message_error'])){ $message_error_span = '<span style="width: 20%"></span><span style="color:red;">'.$message['message_error'].'</span>'; }else{$message_error_span = '' ;}@endphp 
                     @php echo $message_error_span; @endphp 
                      
                      @php if(isset($message['message_success'])){ $message_success_span = '<span style="width: 20%"></span><span style="color:green;">'.$message['message_success'].'</span>'; }else{$message_success_span = '' ;}@endphp 
                      @php echo $message_success_span; @endphp 
                       
                  </div>
              </span>
           
            </div> 
            
            <div class="footer text-center">
               
              <a href="#" onClick="document.getElementById('form').submit();" class="btn btn-primary btn-wd btn-lg">Enviar</a>
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
