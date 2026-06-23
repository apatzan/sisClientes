@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Crear Tipificacion</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'gestion/tipificacion','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="Descripcion">Descripción</label>
      		<input type="text" id="descripcion" style="width: 680px;" class="form-control" name="descripcion" placeholder="Ingrese Descripción">
            </div>
            <div class="form-group">
            	<label for="Estado">Estado</label>
            	   <select name="estado" id="estado" class="form-control" style="width: 400px;" data-live-search="false">
                    
                     <option value="1">1 - Activo</option>
                    <option  value="0">0 - Cancelado</option>
                </select>
				<div class="form-group">
            	<label for="esPromesa">Es Promesa</label>
            	   <select name="esPromesa" id="esPromesa" class="form-control" style="width: 400px;" data-live-search="false">
                    
                     <option value="S">S - Si</option>
                    <option  value="N">N - NO</option>
					<option  value="R">R - Recordatorio</option>
                </select>				
	
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
				 <a href="{{url('gestion/tipificacion')}}" class="btn btn-warning"> Regresar</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection
