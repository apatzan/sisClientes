@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{ $usuario->name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($usuario,['method'=>'PATCH','route'=>['seguridad.usuario.update',$usuario->id]])!!}
            {{Form::token()}}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                            @can('isAdmin')
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}">
                            @endcan 
                            @can('isSupervisor')
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" readonly="readonly">
                            @endcan 
                            @can('isAgente')
                                <input id="name" type="text" class="form-control" name="name" value="{{$usuario->name}}" readonly="readonly">
                            @endcan 

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                            @can('isAdmin')
                                <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}">
                            @endcan
                            @can('isSupervisor')
                                <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}" readonly="readonly">
                            @endcan
                            @can('isAgente')
                                <input id="email" type="email" class="form-control" name="email" value="{{$usuario->email}}" readonly="readonly">
                            @endcan
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('idPerfil') ? ' has-error' : '' }}">
                          <label for="idPerfil" class="col-md-4 control-label">Perfil</label>
                            <div class="col-md-6">
                            @can('isAdmin')
                             <select name="idPerfil" id="idPerfil" class="form-control" style="width: 252px;" data-live-search="false" value="{{$usuario->descripcion}}" >
                             @foreach($perfiles as $perfil)
                            <option @if($usuario->perfil == $perfil->idPerfil) selected  @endif 
                            value="{{$perfil->idPerfil}}">{{$perfil->descripcion}}</option>

                            @endforeach
                            </select>
                            @endcan
                            @can('isSupervisor')
                            <select name="idPerfil" id="idPerfil" class="form-control" style="width: 228px;" data-live-search="false" value="{{$usuario->descripcion}}" >
                             @foreach($perfiles as $perfil)
                            <option  @if($usuario->perfil == $perfil->idPerfil) selected  @endif 
                            value="{{$perfil->idPerfil}}">{{$perfil->descripcion}}</option>

                            @endforeach
                            </select>                            
                            @endcan
                            
                            @can('isAgente')
                            <select name="idPerfil" id="idPerfil" class="form-control" style="width: 228px;" data-live-search="false" value="{{$usuario->descripcion}}">
                             @foreach($perfiles as $perfil)
                            <option  @if($usuario->perfil == $perfil->idPerfil) selected  @endif 
                            disabled value="{{$perfil->idPerfil}}">{{$perfil->descripcion}} </option>

                            @endforeach
                            </select>
                            @endcan                           

                                @if ($errors->has('perfil'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('perfil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
                
            </div>
            <div class="form-group">
            <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>
            @can('isAdmin')
            <div class="form-group">
            <a href="{{url('seguridad/usuario')}}" class="btn btn-warning"> Regresar</a>    
            </div>
			{!!Form::close()!!}
            @endcan

            @can('isSupervisor')
            <div class="form-group">
            <a href="{{url('home')}}" class="btn btn-warning"> Regresar</a>    
            </div>
			{!!Form::close()!!}
            @endcan
            @can('isAgente')
            <div class="form-group">
            <a href="{{url('home')}}" class="btn btn-warning"> Regresar</a>    
            </div>
			{!!Form::close()!!}
            @endcan

            
		</div>
	</div>
@push ('scripts')
<script>
$('#liAcceso').addClass("treeview active");
$('#liUsuarios').addClass("active");
</script>
@endpush
@endsection