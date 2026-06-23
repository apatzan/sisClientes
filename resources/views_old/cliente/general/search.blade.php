{!! Form::open(array('url'=>'cliente/general','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" style="width: 680px;" class="form-control" name="searchText" placeholder="Ingrese Apellidos y Nombres" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}}