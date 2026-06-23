@extends ('layouts.admin')
@section ('contenido')

<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado Diario de Gestiones</h3>
		<h4>Para visualizar las gestiones diarias presione el boton</h4>
		<a href="{{url('reporte/consulta/export')}}" class="btn btn-info">Exportar</a>
	
	</div>
</div>

</div>

@endsection
