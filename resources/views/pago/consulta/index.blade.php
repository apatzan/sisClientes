@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Pagos del día </h3>
		@include('pago.consulta.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Cliente</th>
					<th>Moneda</th>
					<th>Tipo Transaccion</th>
					<th>Monto Pago</th>
					<th>Fecha Pago</th>
					<th>Cuenta</th>

						
				</thead>
               @foreach ($pagos as $pagos)
				<tr>
					<td>{{ $pagos->cliente}}</td>					
					<td>{{ $pagos->moneda}}</td>
					<td>{{ $pagos->tipoTransaccion}}</td>
					<td>{{ $pagos->montoPago}}</td>
					<td>{{ $pagos->fecha_pago}}</td>
					<td>{{ $pagos->cuenta}}</td>

				
				</tr>

				@endforeach
			</table>
		</div>
	
	</div>
</div>

@endsection
