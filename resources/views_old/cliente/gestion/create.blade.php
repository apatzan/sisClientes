@extends ('layouts.admin')
@section ('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Gestión Cliente: {{$cliente->nombre}} </h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!!Form::open(array('url'=>'gestion/alta','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
                <label for="Descripcion">Id Cliente</label>
                <input type="text" name="idCliente" class=form-control" value={{$cliente->id}} readonly>
            </div>
            <div class="form-group">
            	<label>Tipificación</label>
            	<select name="idTipif" id="idTipif" class="form-control" data-live-search="true">
                    @foreach($tipificaciones as $tip)
                     <option value="{{$tip->id_tipif}}">{{$tip->descripcion}}</option>
                     @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="Estado">Observación</label>
                <!--<input type="text" name="observacion" class=form-control" placeholder="Ingrese Observación">-->
                <input type="text" id="myInput"style="width: 680px;" class="form-control" name="observacion" placeholder="Ingrese una observación" value="">
    
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

            {!!Form::close()!!}     
            
        </div>
    </div>
@endsection
