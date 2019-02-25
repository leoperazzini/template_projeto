@extends('container')
  
@section('title') 
 
@endsection

 @section('content')  
        <div class="nav-wrapper ">
            <div class="col s12 ">
                    <a href="/users/getall" class="breadcrumb">Usuários Listar</a>
                    <!--<a href="/users/getall" class="breadcrumb">Listar</a>-->
                    
            </div>
        </div> 
        <hr>
        <br>
        <div class="well">
            <div class="row">
                <div class="col s6">
                    <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">search</i>
                        <input type="text" id="autocomplete-input" class="autocomplete">
                        <label for="autocomplete-input">Busque os detalhes do usuário</label>
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @php if(isset($users['0'])){ @endphp
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>E-mail</th>
                                <th>Data de nascimento</th>
                            </tr>
                        </thead>

                        @php  foreach ($users as $key => $user) { @endphp 
                            <tbody>
                                <tr>
                                    <td>
                                        <label>
                                            <input type="checkbox" class="filled-in" checked="checked" />
                                            <span style="color:black"></span>
                                        </label>
                                    </td>
                                    <td>{{$user['first_name']}}</td>
                                    <td>{{$user['last_name']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['date_birth']}}</td>
                                </tr> 
                            </tbody> 
                        @php } @endphp 
                        
                    </table>
                @php }else{ @endphp

                @php } @endphp 
                    
            </div>
        </div>
 @endsection

 @section('script-js')
    
 @endsection
 