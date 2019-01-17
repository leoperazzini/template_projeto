@php if(!empty($mensagem['msg_erro'])){ @endphp
<div class="col-sm-12">
	<div class="alert alert-danger" role="alert" >{{$mensagem['msg_erro']}}</div><br>
</div>
@php } @endphp
@php if(!empty($mensagem['msg_sucesso'])){ @endphp
<div class="col-sm-12">
	<div class="alert alert-success" role="alert" >{{$mensagem['msg_sucesso']}}</div><br>
</div>
@php } @endphp