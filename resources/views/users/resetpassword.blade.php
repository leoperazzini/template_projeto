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
            <form id="form" class="form" method="POST" action="{{ route('send-reset', $queryString) }}">
                  @csrf
  
                 <input type="hidden" name="public_link_code" value="@php if(isset($data['public_link_code'])){ echo $data['public_link_code'];}@endphp" >
                 <input type="hidden" name="email" value="@php if(isset($data['email'])){ echo $data['email'];}@endphp" >
  
                <div class="card-header card-header-primary text-center">
                      <h4 class="card-title">Template Projeto</h4> 
                </div>  
                <p class="description text-center"> 
                   
                      <i class="material-icons">mail</i>
                          
                      <span class="" style="padding-left: 1rem;">@php if(isset($data['email'])){ echo $data['email'];}@endphp</span>
                      <br>
                      <span class=" " style="color:red;padding-left: 3rem"> 
                                  @php if(isset($errors['email'][0])){ @endphp
                                      @php echo $errors['email'][0]; @endphp
                                  @php  }  @endphp 
                         </span> 
               </p> 
                <div class="card-body">
                    
                  <span class="bmd-form-group">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                              <i class="material-icons">lock_outline</i>
                              </span>
                          </div>
                          <input name ="password" type="password" class="form-control" value="@php if(isset($data['password'])){ echo $data['password'];}@endphp" placeholder="Senha">
                          
                      </div>
                      <span class=" " style="color:red;padding-left: 3rem"> 
                                  @php if(isset($errors['password'][0])){ @endphp
                                      @php echo $errors['password'][0]; @endphp
                                  @php  }  @endphp 
                         </span> 
                  </span>
                  <span class="bmd-form-group">
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">
                              <i class="material-icons">lock_outline</i>
                              </span>
                          </div>
                          <input name ="confirmpassword" type="password" class="form-control" value="@php if(isset($data['confirmpassword'])){ echo $data['confirmpassword'];}@endphp" placeholder="Confirmar senha">
                          
                      </div>  
                        <span class=" " style="color:red;padding-left: 3rem"> 
                                  @php if(isset($errors['confirmpassword'][0])){ @endphp
                                      @php echo $errors['confirmpassword'][0]; @endphp
                                  @php  }  @endphp 
                         </span> 
                  </span>
  
                  <span class="bmd-form-group">
                      <div class="input-group">
                           
                      </div>  
                        <span class=" " style="color:green;padding-left: 3rem"> 
                                  @php if(isset($success) && $success == true){ @endphp
                                      Senha alterada com sucesso!
                                  @php  }  @endphp 
                         </span> 
                  </span>
  
                </div>
                <div class="footer text-center">
                  <a  onClick="document.getElementById('form').submit();" class="btn btn-primary  btn-wd btn-xs">Alterar senha</a>
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
 