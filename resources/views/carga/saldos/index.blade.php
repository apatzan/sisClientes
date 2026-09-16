@extends ('layouts.admin')
@section ('contenido')

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <h3 style="width: 680px;">Carga Masiva de Saldos </h3>



     <form id="form-carga-saldos" method="post" enctype="multipart/form-data" action="{{ url('/carga/saldos/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
       <td width="40%" align="right"><label>Seleccione Archivo</label></td>
       <td width="30">
        <input type="file" name="select_file"  accept=".txt" required="true" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" id="btn-cargar-saldos" class="btn btn-primary" value="Cargar Información">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">El arhivo debe ser formato txt</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>

   @if (session('report'))
    <div class="alert alert-info">{{ session('report') }}</div>
    @endif

    </div>
  </div>

  <div id="loading-overlay-saldos" style="display:none;">
   <div class="loading-overlay-content">
    <i class="fa fa-spinner fa-spin"></i>
    <p>Cargando información, por favor espere...</p>
   </div>
  </div>

  <style>
   #loading-overlay-saldos {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.85);
    z-index: 9999;
    text-align: center;
   }
   #loading-overlay-saldos .loading-overlay-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
   }
   #loading-overlay-saldos .fa-spinner {
    font-size: 48px;
    color: #337ab7;
   }
   #loading-overlay-saldos p {
    margin-top: 15px;
    font-size: 16px;
    color: #333;
   }
  </style>

  <script>
   document.getElementById('form-carga-saldos').addEventListener('submit', function (e) {
    if (!this.checkValidity()) {
     return;
    }
    document.getElementById('btn-cargar-saldos').disabled = true;
    document.getElementById('loading-overlay-saldos').style.display = 'block';
   });
  </script>
@endsection
