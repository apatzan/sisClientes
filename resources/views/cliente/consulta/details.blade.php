@extends ('layouts.admin')
@section ('contenido')

<head>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>


<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-14">

			@can('isSupervisor')
			<a href="{{url('cliente/general')}}"><button class="btn btn-danger">Regresar</button></a>
			@endcan

			@can('isAdmin')
			<a href="{{url('cliente/general')}}"><button class="btn btn-danger">Regresar</button></a>
			@endcan
			@can('isAgente')
			<a href="{{url('cliente/consulta')}}"><button class="btn btn-danger">Regresar</button></a>
			@endcan
<!-- 			
			<a href="{{ URL::action('ClienteController@show', Auth::user()->last_correlativo) }}">
        <button class="btn btn-info">Siguiente</button>

	</a>
		</div>
		<div class="text-end">

@if(isset($clienteSiguiente))
    <a href="{{ URL::action('ClienteController@show', $clienteSiguiente->id) }}">
        <button class="btn btn-info">Siguiente</button>
    </a>
@endif
--> 
</div>
	</div>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-14">
			<h3>Detalles de Cliente: {{ $cliente->nombre}} ({{$cliente->cuenta}})</h3>
		</div>

	</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h4 style="background-color: #e3f2fd">Datos Generales</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
					<th style="width: 150px;">Telefono Casa</th>
					<th style="width: 150px;">Telefono Trabajo</th>
					<th style="width: 150px;">Celular</th>
					<th style="width: 150px;">DPI</th>
					<th style="width: 150px;">Moneda</th>
					<th style="width: 150px;">Gestor</th>
					<th style="width: 150px;">Fecha de Corte </th>
					<th style="width: 150px;">Email </th>
				</thead>
	
				<tr>
				@php

				if ($cliente->saldo >0 and $cliente->saldoVencido >0 and $cliente->saldoD <=0  ){
				$msj = 'Estimado (a) Señor (a) '  . $cliente->nombre . 
							'%0APresente %0A%0A
				Estimado cliente la presente es para darse por notificado que ha sido traslado a nuestra casa de cobranza externa, GLB CONTACT CENTER, S.A. Por el atraso que presenta de Saldo Total Q'
				.$cliente->saldo .' y Pago Mínimo Q'. $cliente->pagoMinimo. 
				 ' en sus pagos con la TARJETA DE CREDITO BANRURAL. Hemos intentado comunicarnos con usted en varias ocasiones. Le agradeceremos que se comunique con nosotros para brindarle soluciones al estado actual de deuda.
				 %0ASirva la presente, como constancia de recordatorio de pago y la finalización de esta etapa, previo a un posible proceso jurídico.

				 %0AEsperamos su respuesta brevemente a los teléfonos PBX 23266810, o al correo electrónico: atp@banrural.com.gt';
				}
				else {
					if ($cliente->saldo >0 and $cliente->saldoVencido >0 and $cliente->saldoD >0){
					$msj = 'Estimado (a) Señor (a) '  . $cliente->nombre . 
							'%0APresente %0A%0A
				Estimado cliente la presente es para darse por notificado que ha sido traslado a nuestra casa de cobranza externa, GLB CONTACT CENTER, S.A. Por el atraso que presenta de Saldo Total Q'
				.$cliente->saldo .' y Pago Mínimo Q'. $cliente->pagoMinimo. ' Saldo Total $'. $cliente->saldoD.' Pago Minimo $'.$cliente->pagoMinimoD.
				 ' en sus pagos con la TARJETA DE CREDITO BANRURAL. Hemos intentado comunicarnos con usted en varias ocasiones. Le agradeceremos que se comunique con nosotros para brindarle soluciones al estado actual de deuda.'.
				 '%0A%0A Sirva la presente, como constancia de recordatorio de pago y la finalización de esta etapa, previo a un posible proceso jurídico.'.

				 '%0AEsperamos su respuesta brevemente a los teléfonos PBX 23266810, o al correo electrónico: atp@banrural.com.gt';
					}else
					{
						$msj = 'Estimado (a) Señor (a) '  . $cliente->nombre . 
						'%0APresente %0A%0A
						Estimado cliente la presente es para darse por notificado que ha sido traslado a nuestra casa de cobranza externa, GLB CONTACT CENTER, S.A. Por el atraso que presenta de Saldo Total $'
				.$cliente->saldoD .' y Pago Mínimo $'. $cliente->pagoMinimoD. 
				 ' en sus pagos con la TARJETA DE CREDITO BANRURAL. Hemos intentado comunicarnos con usted en varias ocasiones. Le agradeceremos que se comunique con nosotros para brindarle soluciones al estado actual de deuda.'.
				 '%0A%0A Sirva la presente, como constancia de recordatorio de pago y la finalización de esta etapa, previo a un posible proceso jurídico.

				 %0AEsperamos su respuesta brevemente a los teléfonos PBX 23266810, o al correo electrónico: atp@banrural.com.gt';	
					};
				};
				@endphp

					<td>{{ $cliente->telCasa}}</td>
					<td>{{ $cliente->telTrabajo}}</td>
					<td>{{ $cliente->celular}}</td>
					<td>{{ $cliente->numDocumento}}</td>
					<td>{{ $cliente->moneda}}</td>
					<td>{{ $cliente->responsable}}</td>
					<td>{{ $cliente->fechaCorte}}</td>
					<td>
					<a href="mailto:{{ $cliente->email}}?Subject=RECORDATORIO DE PAGO BANRURAL &Body={{$msj}} ">
					{{ $cliente->email}}
					</a>
					
		
					</td>

				</tr>
			</table>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-1 col-sm-12 col-xs-12">
	<h4 style="background-color: #e3f2fd">Detalle Quetzales</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
				<th style="width: 150px;">Pago Minimo</th>
				<th style="width: 150px;">Saldo Vencido</th>
					<th style="width: 150px;">Saldo Actual</th>
					<th style="width: 150px;">Saldo Act + Extra</th>
					<th style="width: 150px;">Monto Ultimo Pago</th>
					<th style="width: 150px;">Fecha Ultimo Pago</th>
					<th style="width: 150px;">Cesantes</th>
					<th style="width: 150px;">CuotasVencidas</th>
					
					
				</thead>
				
					
				<tr>
					<td>{{ $cliente->pagoMinimo}}</td>
					<td>{{ $cliente->saldoVencido}}</td>
					<td>{{ $cliente->saldo}}</td>
					<td>{{ $cliente->saldoTotal}}</td>					
					<td>{{ $cliente->montoUltPago}}</td>
					<td>{{ $cliente->fechaUltPago}}</td>
					<td>{{ $cliente->cesantes}}</td>
					<td>{{ $cliente->cuotasVencidas}}</td>
									
					
					
				</tr>
			</table>
		</div>

	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h4 style="background-color: #e3f2fd">Detalle Dólares</h4>
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
					<th style="width: 150px;">Pago Minimo</th>
					<th style="width: 150px;">Saldo Vencido</th>
					<th style="width: 150px;">Saldo Actual</th>					
					<th style="width: 150px;">Monto Ultimo Pago</th>
					<th style="width: 150px;">Fecha Ultimo Pago</th>
					<th style="width: 150px;">Cesantes</th>
					<th style="width: 150px;">CuotasVencidas</th>
					
					
					
				</thead>
   
   
				<tr>
					<td>{{ $cliente->pagoMinimoD}}</td>
					<td>{{ $cliente->saldoVencidoD}}</td>
					<td>{{ $cliente->saldoD}}</td>					
					<td>{{ $cliente->montoUltPagoD}}</td>
					<td>{{ $cliente->fechaUltPagoD}}</td>
					<td>{{ $cliente->cesantesD}}</td>
					<td>{{ $cliente->cuotasVencidasD}}</td>
					
				</tr>
			</table>
		</div>

	</div>
</div>



<!-- Area de Ingreso de Gestiones --> 

<div class="row">
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-14">


{!!Form::open(array('url'=>'gestion/alta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
			            <div class="form-group" id="tipdinamic">
            	<label>Tipificación</label>
					<select name="idTipif" id="idTipif" class="form-control" required>
						<option value="">Seleccione...</option>

						@foreach($tipificaciones as $tip)
							<option value="{{ $tip->id_tipif }}"
									data-espromesa="{{ $tip->esPromesa }}">
								{{ $tip->descripcion }}
							</option>
						@endforeach

					</select>
            </div>
            <div class="form-group">
               
                <input type="hidden" name="idCliente" class=form-control" value={{$cliente->id}} readonly>
				<input type="hidden" name="cuenta" class=form-control" value={{$cliente->cuenta}} readonly>
				<input type="hidden" name="correlativo" class=form-control" value={{$cliente->correlativo}} readonly>
            </div>
            <div class="form-group"  id="obsdinamic">
                <label for="Observacion">Observación</label>
                <body oncopy="return false" onpaste="return false">  
				<input type="text" id="observacion"style="width: 680px;" class="form-control" maxlength="350" name="observacion" placeholder="Ingrese una observación" value="" required>
    
            </div>




			<div class="form-group"id="fechadinamic"  style="display: none;">
                <label for="Fecha">Fecha Promesa/Recordatorio </label>
                <input class="date form-control" id="fechaPromesa"type="text" style="width: 680px;" name="fechaPromesa" required >
             </div>

			 <div class="form-group"id="horadinamic"  style="display: none;">
                <label for="horaRecordatorio">Hora</label>
   
                <input type="time" id="horaRecordatorio"style="width: 680px;" class="form-control" name="horaRecordatorio" required >
    
            </div>

            <div class="form-group" id="save">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

            {!!Form::close()!!}    


<div id="PromesaPago" class="tabcontent">

</div>


     
<script type="text/javascript">

$('.date').datepicker({  

   format: 'yyyy-mm-dd',
   autoclose: true

 });  


 $("#tipoGestion").change(function(event)
 {
	
		$.get(`tipificacion/${event.target.value}`, function(response, state){	
		console.log(response);
		$("#idTipif").empty();
		$("#idTipif").append(`<option value=""></option>`);
		response.forEach(element => {
		$("#idTipif").append(`<option value=${element.id_tipif}> ${element.descripcion} </option>`);

		
		
	});
	});
	
 });


$("#idTipif").change(function () {

    let selectedOption = $(this).find(':selected');
    let esPromesa = selectedOption.data('espromesa');

    if (esPromesa == "N") {

        $("#fechadinamic").hide();
        $("#horadinamic").hide();

        $("#fechaPromesa").prop('disabled', true);
        $("#horaRecordatorio").prop('disabled', true);

    } 
    else if (esPromesa == "S") {

        $("#fechadinamic").show();
        $("#horadinamic").hide();

        $("#fechaPromesa").prop('disabled', false);
        $("#horaRecordatorio").prop('disabled', true);

    } 
    else if (esPromesa == "R") {

        $("#fechadinamic").show();
        $("#horadinamic").show();

        $("#fechaPromesa").prop('disabled', false);
        $("#horaRecordatorio").prop('disabled', false);
    }

});


$('.preventcopy').on('copy paste cut', function(e) {
    e.preventDefault();
});
</script>

</script>


<script>
function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontent" by default */
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

<!-- Fin Area de Ingreso de gestiones -->



	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-6 col-xs-14">	
			<h3>Gestiones:</h3>
		</div>

	</div>
	</div>
<div class="row"onmousedown="return false">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>					
					<th style="width: 20px;">Id Gestion</th>
					<th style="width: 80px;">Fecha</th>
					<th style="width: 100px;">Descripción</th>
					<th style="width: 65px;">Fecha Promesa/Record</th>
					<th style="width: 35px;">Hora Recordatorio</th>
					<th style="width: 200px;">Observación</th>
					<th style="width: 100px;">Usuario Ingreso</th>
				</thead>
			
			<tbody>
               @foreach($gestion as $ges)                               
				<tr>
					<td>{{ $ges->idGestion}}</td>
					<td>{{ $ges->fecha}}</td>
					<td>{{ $ges->descripcion}}</td>
					<td>{{ $ges->fechaPromesa}}</td>
					<td>{{ $ges->horaRecordatorio}}</td>
					<td>{{ $ges->observacion}}</td>
					<td>{{ $ges->userIngreso}}</td>

				</tr>
				@endforeach
             </tbody>
			</table>
		</div>

	</div>
</div>







@endsection
