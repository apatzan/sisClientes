{!! Form::open(array('url'=>'cliente/general','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" style="width: 350px;" class="form-control" name="searchText" placeholder="Ingrese Apellidos y Nombres" value="{{$searchText}}">
		<input type="text" style="width: 170px;" class="form-control" name="cuenta" placeholder="Ingrese Cuenta" value="{{$cuenta}}">
		<input type="text" style="width: 350px;" class="form-control" name="numDocumento" placeholder="Ingrese DPI" value="{{$numDocumento}}">
		<input type="text" style="width: 170px;" class="form-control" name="telefono" placeholder="Tel Casa/Trabajo/Celular" value="{{$telefono}}">

		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}
