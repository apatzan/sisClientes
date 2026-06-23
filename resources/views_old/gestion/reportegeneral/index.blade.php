@extends ('layouts.admin')

@section ('contenido')
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Histórico de Gestiones</h3>
        <h4>Para visualizar las gestiones presione el boton Exportar</h4>
		<a href="{{url('/reporte/general/export')}}" class="btn btn-info">Exportar</a>
	
	</div>

    @endsection