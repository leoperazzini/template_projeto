@php if(!empty($message['message_error'])){ @endphp

	@php if(is_array ($message['message_error'])){
		foreach ($message['message_error'] as $key => $message_error) { 
	@endphp
		<div class="alert alert-danger" role="alert" >{{$message_error}}</div>
	@php }}else{ @endphp
		<div class="alert alert-danger" role="alert" >{{$message['message_error']}}</div>
	@php } @endphp	 

	<br> 
@php } @endphp

@php if(!empty($message['message_success'])){ @endphp

	@php if(is_array ($message['message_success'])){
		foreach ($message['message_success'] as $key => $message_success) { 
	@endphp
		<div class="alert alert-success" role="alert" >{{$message_success}}</div>
	@php }}else{ @endphp
		<div class="alert alert-success" role="alert" >{{$message['message_success']}}</div>
	@php } @endphp	 
	 
	 <br>
@php } @endphp
 