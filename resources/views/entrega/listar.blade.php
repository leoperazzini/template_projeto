 @extends('desafio')

 @section('active')
    @php $active = 'listar' @endphp 
 @endsection

 @section('title') 
   Listagem de entregas
 @endsection

  @section('content')
 
  @include('mensagem') 

  @php if(!empty($entregas[0])){ @endphp
				    
  <div class="col-sm-4">
  	<input class="form-control" id="myInput" type="text" placeholder="Filtre seu endereço ...">
  </div>	 
  <br>
  <table class="table table-bordered table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome do cliente</th>
      <th scope="col">Data de entrega</th>
      <th scope="col">Endereço de partida</th>
      <th scope="col">Endereço de destino</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody id="myTable">
	  	@foreach ($entregas as $umaEntrega) 
	  		<tr>
		      <td scope="row">{{$umaEntrega->id}}</td>
		      <td>{{$umaEntrega->nome_cliente}}</td>
		      <td>@php echo date('d/m/Y', strtotime($umaEntrega->data_entrega)); @endphp </td>
		      <td>{{$umaEntrega->endereco_partida}}</td>
		      <td>{{$umaEntrega->endereco_destino}}</td>
		      <td> 

		      	<a title="Editar a entraga do cliente '{{$umaEntrega->nome_cliente}}'" href="/entrega/editar/id/{{$umaEntrega->id}}" class="btn btn-circle btn-success"><i class="fa fa-edit" aria-hidden="true"></i></a>

		      	<a title="Visualizar rota de entraga para o cliente '{{$umaEntrega->nome_cliente}}'" href="/rota/roterizacao/id/{{$umaEntrega->id}}" class="btn btn-circle btn-primary"><i class="fa fa-map-marker" aria-hidden="true"></i></a>

		      	<a title="Deletar a entraga do cliente '{{$umaEntrega->nome_cliente}}'" href="/entrega/deletar/id/{{$umaEntrega->id}}" class="btn btn-circle btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>

		      </td>
		    </tr> 
	    @endforeach 
     
  </tbody>
 </table>

 

@php }else{ @endphp
	<div class="alert alert-warning" role="alert">Nenhuma entrega encontrada.</div>
@php } @endphp
 
 @endsection

 @section('script-js')
  <script>
	$(document).ready(function(){
	  $("#myInput").on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#myTable tr").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	});
 </script>
  @endsection