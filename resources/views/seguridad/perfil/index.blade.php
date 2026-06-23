@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de perfiles <a href="perfil/create"><button class="btn btn-success">Nuevo	</button></a></h3>
		@include('seguridad.perfil.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Descripción</th>
		
				</thead>
               @foreach ($perfiles as $perfil)
				<tr>
					<td>{{ $perfil->idPerfil}}</td>
					<td>{{ $perfil->descripcion}}</td>
					<td>
						<a href="{{URL::action('PerfilController@edit',$perfil->idPerfil)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$perfil->idPerfil}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('seguridad.perfil.modal')
				@endforeach
			</table>
		</div>
		{{$perfiles->render()}}
	</div>
</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liUsuarios').addClass("active");
</script>
@endpush
@endsection