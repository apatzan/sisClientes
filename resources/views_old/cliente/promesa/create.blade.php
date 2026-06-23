@extends ('layouts.admin')
@section ('contenido')


<head>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nueva Promesa de  Cliente: {{$cliente->nombre}} </h3>
            @if (count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
            @endif

            {!!Form::open(array('url'=>'promesa/alta','method'=>'POST','autocomplete'=>'off'))!!}
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
                <label for="Fecha">Fecha Promesa</label>
                <!--<input type="text" name="observacion" class=form-control" placeholder="Ingrese Observación">-->
                <input class="date form-control" type="text" name="fechaPromesa">
             </div>
             <script type="text/javascript">

    $('.date').datepicker({  

       format: 'yyyy-mm-dd',
       autoclose: true

     });  
</script>

            <div class="form-group">
                <button class="btn btn-primary" type="submit">Guardar</button>
                <button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

            {!!Form::close()!!}     
            
        </div>
    </div>
@endsection
