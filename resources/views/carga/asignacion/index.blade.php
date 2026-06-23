@extends ('layouts.admin')
@section ('contenido')

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3 style="width: 680px;">Asignación de Cuentas a Gestores</h3>



     <form method="post" enctype="multipart/form-data" action="{{ url('/carga/asignacion/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Seleccione Archivo</label></td>
       <td width="30">
        <input type="file" name="select_file"  accept=".txt" required="true" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Procesar asignación">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">Nota: recuerde que el archivo debe de tener extensión .txt</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>

   @if (session('report'))
    <div class="alert alert-info">{{ session('report') }}</div>
    @endif
   </form>
            
    </div>
  </div>
@endsection
