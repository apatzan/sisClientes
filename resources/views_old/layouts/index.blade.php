@extends ('layouts.admin')

@section ('contenido')
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Bienvenido al Sistema {{ Auth::user()->name }}</h3>
        <h4></h4>
	</div>

    @endsection