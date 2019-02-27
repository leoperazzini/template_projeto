@extends('container')
   
@section('title')  
  <title>
    Listar Usuários - Template Projeto
    @php $active = 'Administrativo'; @endphp
  </title> 
@endsection

@section('breadcrumb')  
  <nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb"> 
        <li class="breadcrumb-item"><a href="/users/getall">Listar Usuários</a></li>
      <li class="breadcrumb-item active" aria-current="page">Cadastrar Usuário</li>
    </ol>
  </nav>
@endsection 

 @section('content')
 
<!------ Include the above in your HEAD tag ---------->
<form method="POST" action="/users/store">
    @csrf
    <div class="card">
         <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Usuário</h4> 
        </div>
        <div class="card-body">
            @include('message') 
            <div class = "row"> 
 
                <div class = "col-sm-6">
                     @php if(isset($errors['first_name'][0])){ 
                        $error = '<b style="color:red;">'.$errors['first_name'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 
                    
                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Nome</label>
                        <input type="text" class="form-control" name = "first_name" value ="@php if(isset($data['first_name'])){ echo $data['first_name'];} @endphp">
                    </div>
                    @php echo $error; @endphp
                </div>

                <div class = "col-sm-6">
                     @php if(isset($errors['last_name'][0])){ 
                        $error = '<b style="color:red;">'.$errors['last_name'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Sobrenome</label>
                        <input type="text" class="form-control" name = "last_name" value ="@php if(isset($data['last_name'])){ echo $data['last_name'];} @endphp">
                    </div>
                    @php echo $error; @endphp
                </div>

                <div class = "col-sm-12">
                    <br>
                </div>

                <div class = "col-sm-4">
                     @php if(isset($errors['email'][0])){ 
                        $error = '<b style="color:red;">'.$errors['email'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* E-mail</label>
                        <input type  = "email" name  = "email" class = "form-control" value = "@php if(isset($data['email'])){ echo $data['email'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
                </div> 

                <div class = "col-sm-4">
                    @php if(isset($errors['password'][0])){ 
                        $error = '<b style="color:red;">'.$errors['password'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Senha</label>
                        <input name  = "password" type  = "password" class = "form-control" value = "@php if(isset($data['password'])){ echo $data['password'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
                </div> 

                <div class = "col-sm-4">
                    @php if(isset($errors['date_birth'][0])){ 
                        $error = '<b style="color:red;">'.$errors['date_birth'][0].'</b>'; $class_form_group='has-danger';}else
                        {$error = ''; $class_form_group='';}@endphp 
 

                    <div class="form-group bmd-form-group @php echo $class_form_group; @endphp">
                        <label class="label-control">* Data de Nascimento</label>
                        <input  name  = "date_birth" autocomplete="off" type="text" class = "form-control datetimepicker" value = "@php if(isset($data['date_birth'])){ echo $data['date_birth'];} @endphp" />
                    </div>
                    @php echo $error; @endphp
                </div> 

                <div class = "col-sm-12">
                    <br>
                </div>

                <div class = "col-sm-12">
                    <center><button type="submit" class="btn btn-primary btn-round">Cadastrar</button></center>
                </div> 
               
            </div>
        </div> 
    </div> 
</form> 

 @endsection

 @section('script-js')
 <script>
        $('.datetimepicker').datetimepicker({ 
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
            },
            format: 'DD/MM/YYYY', 
        });
 </script> 
 @endsection