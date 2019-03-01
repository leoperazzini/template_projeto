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
      <li class="breadcrumb-item active" aria-current="page">Listar Usuários</li>
    </ol>
  </nav>
@endsection 

 @section('content')
 
    <div class="row">
        
        <div class="col-md-12">@include('message') </div>

        <div class="col-md-10"></div>
        <div class="col-md-2"><a href="/users/store"  class="btn btn-primary btn-round">Cadastrar</a></div>
        
        @php if(isset($users['0'])){ @endphp
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Usuários</h4>
                  <!-- <p class="card-category"> Here is a subtitle for this table</p> -->
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>E-mail</th>
                                <th>Data de nascimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                      <tbody>
                        @php  foreach ($users as $key => $user) { @endphp  
                            <tr>
                                <td>
                                    <div class="form-check" style="padding-top:8px">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="{{$user['id']}}">
                                             
                                            <span class="form-check-sign">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{$user['first_name']}}</td>
                                <td>{{$user['last_name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>@php echo date('d/m/Y', strtotime($user['date_birth'])); @endphp</td>
                                <td class="td-actions">
                                    <a href="/users/update/@php echo $user['id'];@endphp"  data-toggle="tooltip"  data-original-title="Editar Usuário"
                                     data-placement="left" class="btn btn-primary btn-fab btn-fab-mini btn-round" >
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button
                                     user_id = "@php echo $user['id'];@endphp" 
                                     user_name = "@php echo $user['first_name'].' '.$user['last_name'];@endphp" 
                                     data-toggle="tooltip"  data-original-title="Excluir Usuário"
                                     data-placement="top" class="button_delete_user btn btn-danger btn-fab btn-fab-mini btn-round" aria-describedby="tooltip874702">
                                        <i class="material-icons">close</i>
                                    </button>

 
                                </td>
                            </tr>  
                         @php } @endphp 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>  
        @php }else{ @endphp
            <span class="badge badge-primary">Nenhum usuário encontrado.</span>
        @php } @endphp   
    </div>
  
    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header  ">
            <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              Deseja excluir o usuário "<span id="name_user_delete"></span>" ?
          </div>
          <div class="modal-footer">
          
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <a href="#" id="button_delete_user_confirm" class="btn btn-primary">Excluir</a>
          </div>
        </div>
      </div>
    </div>
 @endsection

 @section('script-js')
 <script>
        $('.btn-fab').tooltip(); 
        $('.button_delete_user').click( function (){
            var user_id = $(this).attr('user_id');
            var user_name = $(this).attr('user_name');

          $("#name_user_delete").html(user_name);

          $("#button_delete_user_confirm").attr("href", "/users/delete/"+user_id );

          $('#ModalDelete').modal();
        });
        
 </script> 
 @endsection