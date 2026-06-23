<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use DB;

class pagosController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index()
    {


     return view('carga.pagos.index'); 
     }


       public function import (Request $request)
    {
		$count = 0;
		$lines =0;
		$filename =  $request->file('select_file')->getRealPath();
		
		$separador =  $request->separador;
		if($separador=='tabulador')
		{
			$separador='	';
		}
		$numbOfLines = count(file($filename))-1;  // El archivo que procesa GLB tiene una linea extra, obtengo el numero de lineas y quito la linea vacia
		$file =fopen($filename, "r");

		while(!feof($file) and $lines <$numbOfLines){
			$content =fgets($file);
			$carray=explode($separador, $content);
			if ($count >0){	
			list ($cliente,$moneda,$tipo_transaccion,$razon_transaccion,$monto_pago,$fecha_pago,$narrativo,$cuenta,$es_core)=$carray;
			$fecha_pago = date('Y-m-d', strtotime($fecha_pago));		
			$query = DB::insert('insert into `pagos` (`cliente`,`moneda`,`tipoTransaccion`,`razonTransaccion`,`montoPago`,`fecha_pago`,`narrativo`,`cuenta`,`esCore`) values(?,?,?,?,?,?,?,?,?)',
				[$cliente,$moneda,$tipo_transaccion,$razon_transaccion,$monto_pago,$fecha_pago,$narrativo,$cuenta,$es_core]);
				$lines++;
			}else {
				$count = 1;
			}
			}

			fclose($file);	
		

		 $request->session()->flash('report', 'Se ha cargado la información');
         return back();
    	
}
}
