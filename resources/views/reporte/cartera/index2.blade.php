@extends ('layouts.admin')

@section ('contenido')
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Reporte sumarizado de cuentas por estado</h3>
        <h4>Para visualizar el reporte presione el boton exportar</h4>
		<a href="{{url('/reporte/cartera/export')}}" class="btn btn-info">Exportar</a>
	
	</div>

    @endsection