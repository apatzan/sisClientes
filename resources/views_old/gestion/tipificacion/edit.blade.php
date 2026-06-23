@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Tipificación: {{ $tipificacion->descripcion}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($tipificacion,['method'=>'PATCH','route'=>['gestion.tipificacion.update',$tipificacion->id_tipif]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="tipificacion">Descripcion</label>
            	<input type="text" name="descripcion" class="form-control" value="{{$tipificacion->descripcion}}" placeholder="Descripción">
            </div>
            <div class="form-group">
            	<label for="estado">Estado</label>

            	<select name="estado" id="estado" class="form-control" style="width: 400px;" data-live-search="false">                    
                     <option value="1">1 - Activo</option>
                    <option  value="0">0 - Cancelado</option>
                </select>
			 </div>
             <div class="form-group">
				<label for="esPromesa">Es Promesa</label>
            	<select name="esPromesa" id="esPromesa" class="form-control" style="width: 140px;" data-live-search="false">

				<option @if($tipificacion->esPromesa == "S") selected  @endif 
                            value="S">S - SI </option>
							<option @if($tipificacion->esPromesa == "N") selected  @endif 
                            value="N">N - No </option>
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
