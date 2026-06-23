@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-1">
			<h3>Nuevo Perfil</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'seguridad/perfil','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" class="col-md-4 control-label">Descripcion</label>

                            <div class="col-md-6">
                                <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}">

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
             </div>


            <div class="form-group">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-1 ">
            	<button class="btn btn-danger" type="reset">Cancelar</button>
				<button class="btn btn-primary" type="submit">Guardar</button>
			</div>	
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liPerfiles').addClass("active");
</script>
@endpush
@endsection