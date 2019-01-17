 @extends('desafio')
 
 @section('active')
    @php $active = 'roterizacao' @endphp
 @endsection

 @section('title') 
   Melhor Rota
 @endsection

  @section('content')

  	 <div id="informacao">
  	 	<div class="row">
  	 		<div class="col-sm-12">
  	 			<div id="msg_erro_maps"></div>
  	 		</div>
  	 	</div>

  	 	<div class="row">
  	 		<div class="col-sm-12">
  	 			<h5>Dados da entrega</h5>
  	 		</div>

  	 		<div class="col-sm-4">
	  	 		<b>Nome do cliente: </b> {{$entrega->nome_cliente}} <br>

	  	 		<b>Data de entrega: </b> @php echo date('d/m/Y', strtotime($entrega->data_entrega)); @endphp
	  	 	</div>

	  	 	<div class="col-sm-8">
	  	 		<b>Endereço de partida (A): </b> {{$entrega->endereco_partida}}<br>

	  	 		<b>Endereço de destino (B): </b> {{$entrega->endereco_destino}}
	  	 	</div> 
	  	 </div>

	  	 <hr>

	  	 	<div class="row">
		  	 	<div class="col-sm-4">
		  	 		<input id="origin-input" class="controls" type="text" value="{{$entrega->endereco_partida}}" style="width: 100%"
	        		placeholder="Endereço de partida">
		  	 	</div>
		  	 	<div class="col-sm-4">
		  	 		<input id="destination-input" class="controls" type="text" value="{{$entrega->endereco_destino}}" style="width: 100%"
		        	placeholder="Endereço de destino"> 
		  	 	</div> 

	  	 	</div>
	  	 </div>

	  	 <br>
  	 </div>  
  </head> 
 

    <div id="map"></div>
 
 @endsection
 

  @section('script-js') 
  	   	    <script> 

      function initMap() {
      	// iniciando a API do goole maps
        var map = new google.maps.Map(document.getElementById('map'), {
          mapTypeControl: false,
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 7
        });

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
        var originInput = document.getElementById('origin-input');
        var destinationInput = document.getElementById('destination-input');
  
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
   
        inicializaMapa(this.directionsService, this.directionsDisplay);

      }

      function inicializaMapa(directionsService, directionsDisplay) {
      	 	// inicializa o mapa com os dados vindo diretamente do banco
	        directionsService.route({
	          origin: $("#origin-input").val(),
	          destination: $("#destination-input").val(),
	          travelMode: 'WALKING'
	        }, function(response, status) {
	          if (status === 'OK') {
	            directionsDisplay.setDirections(response);
	             $('#msg_erro_maps').html('');
	          } else {
	          	 $('#msg_erro_maps').html('<div class="alert alert-danger" role="alert" > A roterização falhou! Por favor, tente editar manualmente através da caixa com os endereços no mapa.</div>');
	          }
	        });
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
          me.route();
        });

      };

      AutocompleteDirectionsHandler.prototype.route = function() {
      		// seta a localizacao escolhida pelo usuário podendo ser por id place ou por string direta
	      	var me = this;
 			
	        if (!this.originPlaceId && this.destinationPlaceId) {
	           	this.directionsService.route({
			          origin: $("#origin-input").val(),
			          destination: {'placeId': this.destinationPlaceId},
			          travelMode: this.travelMode
			        }, function(response, status) {
			          if (status === 'OK') {
			            me.directionsDisplay.setDirections(response);
			            $('#msg_erro_maps').html('');
			          } else {
			            $('#msg_erro_maps').html('<div class="alert alert-danger" role="alert" > A roterização falhou! Por favor, tente editar manualmente através da caixa com os endereços no mapa.</div>');
			          }
			        });
			   	
	        }

	        if (this.originPlaceId && !this.destinationPlaceId) {
	           	this.directionsService.route({
			          origin: {'placeId': this.originPlaceId},
			          destination: $("#destination-input").val(),
			          travelMode: this.travelMode
			        }, function(response, status) {
			          if (status === 'OK') {
			            me.directionsDisplay.setDirections(response);
			            $('#msg_erro_maps').html('');
			          } else {
			            $('#msg_erro_maps').html('<div class="alert alert-danger" role="alert" > A roterização falhou! Por favor, tente editar manualmente através da caixa com os endereços no mapa.</div>');
			          }
			        });
			    
	        }

	        if (this.originPlaceId && this.destinationPlaceId) {
	           	this.directionsService.route({
			          origin: {'placeId': this.originPlaceId},
			          destination: {'placeId': this.destinationPlaceId},
			          travelMode: this.travelMode
			        }, function(response, status) {
			          if (status === 'OK') {
			            me.directionsDisplay.setDirections(response);
			            $('#msg_erro_maps').html('');
			          } else {
			            $('#msg_erro_maps').html('<div class="alert alert-danger" role="alert" > A roterização falhou! Por favor, tente editar manualmente através da caixa com os endereços no mapa.</div>');
			          }
			        });
			    
	        }
  
      };

         
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkpaADXV6tDM8LslLxs262sDnTyDQJe0A&libraries=places&callback=initMap"
        async defer></script> 
  @endsection