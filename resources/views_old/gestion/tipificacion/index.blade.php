@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Tipificaciones <a href="tipificacion/create"><button class="btn btn-reset">Agregar</button></a></h3>
		@include('gestion.tipificacion.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Descripción</th>
					<th>Estado</th>
					<th>Acciones</th>
				</thead>
               @foreach ($tipificaciones as $tip)
				<tr>
					<td>{{ $tip->id_tipif}}</td>
					<td>{{ $tip->descripcion}}</td>
					<td>{{ $tip->estado}}</td>
					<td>
						<a href="{{URL::action('TipificacionController@edit',$tip->id_tipif)}}"><button class="btn btn-info">Modificar</button></a>
                        <a href="" data-target="#modal-delete-{{$tip->id_tipif}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('gestion.tipificacion.modal')
				@endforeach
			</table>
		</div>
		{{$tipificaciones->render()}}
	</div>
</div>

@endsection
