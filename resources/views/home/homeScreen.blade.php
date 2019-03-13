@extends('container')
  
@section('title')  
  <title>
    Home - Template Projeto
    @php $active = 'Home'; @endphp
  </title> 
@endsection

@section('breadcrumb')  
  <nav aria-label="breadcrumb" role="navigation">
    <ol class="breadcrumb"> 
      <li class="breadcrumb-item active" aria-current="page">Tela Inicial</li>
    </ol>
  </nav>
@endsection 

 @section('content')
 
  <div style="text-align: center">
    <h2>
        Bem vindo {{$user['first_name']}}!
    </h2>
  </div>
 @endsection

 @section('script-js')
    
 @endsection

 