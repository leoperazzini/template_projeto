 @extends('desafio')

 @section('active')
   @php $active = 'cadastrar' @endphp 
 @endsection

  @section('title') 
   Cadastro de entregas
 @endsection

  @section('content')
  	<form method="post" action="" class="form-signin">

  		{{csrf_field() }}
		<div class="well">

			<div class="row">
				 <div class="col-sm-1">

				 </div>

				 <div class="col-sm-11">
				 		 @include('mensagem')
				 </div> 
			</div>

			<div class="row">
				 <div class="col-sm-1">
	
				 </div>

				 <div class="col-sm-1">
				 		<b>Nome do cliente: </b>
				 </div>

				 <div class="col-sm-4"> 
  						<input type="text" name="nome_cliente" id="nome_cliente" class="form-control" placeholder="Nome do cliente" value="{{$dados['nome_cliente']}}" autofocus=""><br>
				 </div> 
			</div>
 
			<div class="row">
				 <div class="col-sm-1">

				 </div>

				 <div class="col-sm-1">
				 		<b>Endereço de partida: </b>
				 </div>

				 <div class="col-sm-8"> 
  						<input type="text" name="endereco_partida" id="endereco_partida" class="form-control" placeholder="Endereço de partida" value="{{$dados['endereco_partida']}}"  style="width: 100%"><br>
				 </div> 
			</div>

			<div class="row">
				 <div class="col-sm-1">

				 </div>

				 <div class="col-sm-1">
				 		<b>Endereço de destino: </b>
				 </div>

				 <div class="col-sm-8"> 
  						<input type="text" name="endereco_destino" id="endereco_destino" class="form-control" placeholder="Endereço de destino" value="{{$dados['endereco_destino']}}" style="width: 100%" ><br>
				 </div> 
			</div>

			<div class="row">
				 <div class="col-sm-1">

				 </div>

				 <div class="col-sm-1">
				 	<b>Data de entrega: </b>
				 </div>

				 <div class="col-sm-2"> 
  						<input type="text" autocomplete = "off" name="data_entrega" id="data_entrega" class="form-control" placeholder="Data da entrega" value="{{$dados['data_entrega']}}" autofocus=""><br><br>
				 </div> 
			</div>

			<div class="row">
				 <div class="col-sm-2">

				 </div>

				 <div class="col-sm-2"> 
  						<center><button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button></center>
				 </div> 
			</div>
		</div>
	</form>  

	<div id="map"></div>
 
  @endsection

  @section('script-js')
  	<script type="text/javascript">
		$( document ).ready(function() {

			$('#data_entrega').datepicker({
			    format: 'dd/mm/yyyy',
			    
			});
		});
	</script>

	 <script> 

      function initMap() {
      	// iniciando a API do goole maps
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 7
        });

        $("#map").hide();

        new AutocompleteDirectionsHandler(map);
  
      }  

       /**
        * @constructor
       */
      function AutocompleteDirectionsHandler(map) { 
        this.map = map;
        this.originPlaceId = null;
        this.destinationPlaceId = null;
        this.travelMode = 'WALKING';
        var originInput = document.getElementById('endereco_partida');
        var destinationInput = document.getElementById('endereco_destino');
  
        var modeSelector = document.getElementById('mode-selector');
        this.directionsService = new google.maps.DirectionsService;
        this.directionsDisplay = new google.maps.DirectionsRenderer;
        this.directionsDisplay.setMap(map);

        var originAutocomplete = new google.maps.places.Autocomplete(
            originInput, {place_id: true});
        var destinationAutocomplete = new google.maps.places.Autocomplete(
            destinationInput, {place_id: true}); 

        this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
        this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
    

      }
  
      AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
      	// codigo de auto complete, caso o usuário queira modificar através do input a sua localização no mapa
        var me = this;
        autocomplete.bindTo('bounds', this.map);

        autocomplete.addListener('place_changed', function() {
          var place = autocomplete.getPlace();
          if (!place.place_id) { 
            return;
          }
          if (mode === 'ORIG') {
            me.originPlaceId = place.place_id;
          } else {
            me.destinationPlaceId = place.place_id;
          }
          
        });

      };
  
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkpaADXV6tDM8LslLxs262sDnTyDQJe0A&libraries=places&callback=initMap"
        async defer></script> 
  @endsection



 
