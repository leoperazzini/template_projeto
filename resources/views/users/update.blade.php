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
      <li class="breadcrumb-item active" aria-current="page">Editar Usuário</li>
    </ol>
  </nav>
@endsection 

 @section('content')
 
<!------ Include the above in your HEAD tag ---------->
<form method="POST" action="/users/update/@php if(isset($data['id'])) { echo $data['id']; } @endphp">
    @csrf

    <input type="hidden" name="id" value="@php if(isset($data['id'])) { echo $data['id']; } @endphp">

    <div class="card">
         <div class="card-header card-header-primary">
            <h4 class="card-title ">Editar Usuário</h4> 
        </div>
        <div class="card-body">
            @include('message') 
            <div class = "row"> 

                @include('users/formUserUpdate') 
  
                <div class = "col-sm-12">
                    <br>
                </div>

                <div class = "col-sm-12">
                    <center><button type="submit" class="btn btn-primary btn-round">Editar</button></center>
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