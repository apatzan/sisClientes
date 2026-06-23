{!! Form::open(array('url'=>'pago/consulta','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="text" id="myInput"style="width: 680px;" class="form-control" name="searchText" placeholder="Ingrese # Cuenta" value="{{$searchText}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>			
			<td></td>
			<button class="btn btn-warning" onclick="document.getElementById('myInput').value = ''" style="margin-left:  10px;">Restaurar</button>
		</span>

	</div>
</div>


{{Form::close()}}
