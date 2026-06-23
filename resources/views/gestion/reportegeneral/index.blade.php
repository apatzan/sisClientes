@extends ('layouts.admin')
@section ('contenido')


<head>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
</head>


{!!Form::open(array('url'=>'/reporte/general/export','method'=>'GET','autocomplete'=>'off'))!!}
{{Form::token()}}

<div class="form-group">
	<div class="input-group">
	<h3>Reporte de Gestiones por Rango de Fecha</h3>
	
				
		<input class="date form-control" type="text" name="fechaInicial" id ="fechaInicial"  style="width: 100px;" placeholder="fecha Inicial" required >
		
		<input class="date form-control" type="text" name="fechaFinal" id ="fechaFinal"  style="width: 100px;" placeholder="fecha Final" required >
		
					<button type="submit" class="btn btn-info">Exportar</button>
		
		
	</div>
</div>

{{Form::close()}}

	<script type="text/javascript">
    $('.date').datepicker({  
       format: 'yyyy-mm-dd',
	   autoclose:true,
	   orientation: "bottom"
     });  
</script>


    @endsection