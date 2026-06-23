@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3 style="display:inline;">Listado de Clientes </h3>  <a href="{{url('/cliente/export')}}" style="float:right;">Exportar</a>
		@include('cliente.consulta.search')
	

	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Cuenta</th>
					<th>Nombres</th>
					<th>Anotacion</th> 
					<th>Acciones</th>
				</thead>
               @foreach ($clientes as $cli)
				<tr>
					<td>{{ $cli->id}}</td>					
					<td>{{ $cli->cuenta}}</td>
					<td>{{ $cli->nombre}}</td>
					
					@if(isset($cli->horaRecordatorio))
						
						<td bgcolor="#EBC1A3" >Llamar {{ $cli->fechaPromesa}} a {{ $cli->horaRecordatorio}}</td>
						
						@else
						@if(isset($cli->fechaPromesa))
						
						<td bgcolor="#A6D3D9" >Promesa vence: {{ $cli->fechaPromesa}}</td>
						
						@else
						@if($cli->prioridad==1)
						
						<td bgcolor="#C0C0C0" >Cliente nuevo</td>
						@else
						<td></td>
						@endif
						@endif
						@endif
					<td>
						<a href="{{URL::action('ClienteController@show',$cli->id)}}"><button class="btn btn-info">Ver Detalles</button></a>
                      <!--  <a href="" data-toggle="modal"><button class="btn btn-danger">Boton extra</button></a> -->
					</td>
				</tr>

				@endforeach
			</table>
		</div>
		{{$clientes->render()}}
	</div>
</div>

@endsection
