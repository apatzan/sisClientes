<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use DB;

class saldosController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        
	}
	
    public function index()
    {


     return view('carga.saldos.index'); 
     }


       public function import (Request $request)
    {



		// Logica para los recordatorios
		DB::unprepared('CREATE OR REPLACE EVENT act_recor
		ON SCHEDULE EVERY 15 MINUTE
		STARTS DATE_FORMAT(NOW(), "%Y-%m-%d %H:00:00") -- Hora de inicio
		ENDS DATE_FORMAT(NOW(), "%Y-%m-%d 23:59:00") -- Hora de inicio
		ON COMPLETION NOT PRESERVE ENABLE
		  DO 
		call act_recordatorio();');	
	

    	$filename =  $request->file('select_file')->getRealPath();


// Función anterior, se ha mejorado para procesar los registros 1 a 1 
/*
		$data="LOAD DATA LOCAL INFILE '".$filename."' REPLACE INTO TABLE  act_saldos FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n'";	

		$pdo = DB::connection()->getPdo();
		$pdo->exec($data);
		
*/

		$count = 0;
		$lines =0;
		$file =fopen($filename, "r");
		$numbOfLines = count(file($filename))-1;  // El archivo que procesa GLB tiene una linea extra, obtengo el numero de lineas y quito la linea vacia
		while(!feof($file) and $lines <$numbOfLines){
			
			$content =fgets($file);
			$carray=explode("|", $content);
			if ($count >0 )  // Exclusión de los encabezados
			{		
		//	$MegRegion=$carray[0];
		//	$Region=$carray[1];
		//	$codAgencia=$carray[2];
		//	$agencia=$carray[3];
		//	$codProm=$carray[4];
		//	$promotor=$carray[5];
			$nombreCliente=$carray[6];
		//	$nit=$carray[7];
			$numDocumento=$carray[8];
		//	$direccionCasa=$carray[9];
		//	$municipioCasa=$carray[10];
		//	$deptoCasa=$carray[11];
		//	$direccionTrabajo=$carray[12];
		//	$municipioTrabajo=$carray[13];
		//	$deptoTrabajo=$carray[14];
			$telefonoCasa=$carray[15];
			$telefonoTrabajo=$carray[16];
			$celular=$carray[17];
			$email=$carray[18];
			$moneda=$carray[19];
			$cuotasVencidas=$carray[20];
		//	$diasMora=$carray[21];
			$saldoActual=$carray[22];
		//	$saldoActualQ=$carray[23];
			$saldoVencido=$carray[24];
			$saldoVencidoQ=$carray[25];
			$pagoMinimo=$carray[26];
		//	$limiteCredito=$carray[27];
		//	$codEmision=$carray[28];
		//	$tipoEmision=$carray[29];
		//	$contagio=$carray[30];
		//	$fechaEmision=$carray[31];
			$montoUltimoPago=$carray[32];
			$fechaUltimoPago=$carray[33];
		//	$ciclo=$carray[34];
			$fechaCortePago=$carray[35];
		//	$cuotaExtraf=$carray[36];
			 $montoExtraf=$carray[37];
		//	$Mis=$carray[38];
			$cesantes=$carray[39];
		//	$pmVencido30=$carray[40];
		//	$pmVencido60=$carray[41];
		//	$pmVencido90=$carray[42];
		//	$pmVencido120=$carray[43];
		//	$pmVencido150=$carray[44];
		//	$pmVencido180=$carray[45];
		//	$pmVencido210=$carray[46];
		//	$pmVencido240=$carray[47];
		//	$pmVencido270=$carray[48];
		//	$pmVencido300=$carray[49];
		//	$pmVencido330=$carray[50];
		//	$pmVencido360=$carray[51];
		//	$fechaConvenio=$carray[52];
		//	$valorConvenio=$carray[53];
			$cuenta=$carray[54];
			//$contraReserva=$carray[55];
	

			$query = DB::insert('insert into `act_saldos` (
						`nombreCliente`,
						`telefonoCasa`,
						`telefonoTrabajo`,
						`celular`,
						`email`,
						`moneda`,
						`cuotasVencidas`,
						`saldoActual`,
						`saldoVencido`,
						`saldoVencidoQ`,
						`pagoMinimo`,
						`montoUltimoPago`,
						`fechaUltimoPago`,
						`fechaCortePago`,					
						`cesantes`,
						`cuenta`,
						`montoExtraf`,
						`numDocumento`
						) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
				[		$nombreCliente,
						$telefonoCasa,
						$telefonoTrabajo,
						$celular,
						$email,
						$moneda,
						$cuotasVencidas,
						$saldoActual,
						$saldoVencido,
						$saldoVencidoQ,
						$pagoMinimo,
						$montoUltimoPago,
						$fechaUltimoPago,
						$fechaCortePago,
						$cesantes,
						$cuenta,
						$montoExtraf,
						$numDocumento
						]);

						$lines++;
			}
			else {
				$count = 1;
			}
			
					}

			fclose($file);

				// Carga de saldos
			DB::statement('call act_Saldos()');
			DB::statement('call asigna_responsables()');



			$request->session()->flash('report', 'Se ha cargado la información');
			return back();


		
		
			

    	 return view('carga.saldos.index');
}
}