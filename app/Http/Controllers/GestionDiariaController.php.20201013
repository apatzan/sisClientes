<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Carbon\Carbon;

class GestionDiariaController extends Controller
{
   
       /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // Muestsra el listado de gestiones diarias a pantalla (una gestion por cliente, si el cliente tiene mas de una, solo se muestra la ultima) 
    public function index()
    {

     // $gestiones=DB::select('SELECT monthname(fecha) as nombre, info as CantGestiones from tmp_data');   
        return view('reporte.consulta.index');
        }

  // Muestra el reporte general de gestiones (acumuladas)      
   public function index2()
    {
  
        return view('gestion.reportegeneral.index');
    }

    public function index3()
    {
        return view('reporte.cartera.index');
       
    }
    public function index4()
    {
        return view('reporte.cartera.index2');
       
    }

    public function excel (){
        // Pendiente agregar la fecha 
        $mytime=Carbon::now()->toDateTimeString();

        Excel::create('GestionesDiarias'.$mytime,function($excel){
            $excel->sheet('Gestiones',function($sheet){
                $gestionesDiarias =DB::select('SELECT cuenta,fchPrimGestion as PrimeraFecha,g.fecha as fecha, t.descripcion as tipificacion, 
                g.observacion as comentario , c.responsable as Gestor,
                c.cuotasVencidas as CuotasVencidasQ, c.cuotasVencidasD as CuotasVencidasD
                from gestion g 	
                    inner join cliente c on g.idCliente = c.id and g.idGestion = c.ultGestion
                    inner join tipificacion t on g.idTipif = t.id_tipif
                    and (t.esPromesa !="R")
                                where convert(g.fecha,DATE) = convert(now(),DATE);');
            $gestionesDiarias= json_decode( json_encode($gestionesDiarias), true);
            $sheet->fromArray($gestionesDiarias);                   
            });    
        
        })->export('xls');
    }    

    public function excel2 (){
        // Pendiente agregar la fecha 
        $mytime=Carbon::now()->toDateTimeString();
        Excel::create('HistoricoGestiones'.$mytime,function($excel){
            $excel->sheet('Gestiones_historico',function($sheet){
                $gestionesDiarias =DB::select('SELECT cuenta,g.fecha as fecha, t.descripcion as tipificacion, 
                g.observacion as comentario from gestion g 	
                    inner join cliente c on g.idCliente = c.id 
                    inner join tipificacion t on g.idTipif = t.id_tipif
                    where esPromesa!="R";
                    ');
            $gestionesDiarias= json_decode( json_encode($gestionesDiarias), true);
            $sheet->fromArray($gestionesDiarias);                   
            });    
        
        })->export('xls');
    }

    public function excel3 (){
        // Pendiente agregar la fecha 
        $mytime=Carbon::now()->toDateTimeString();
        Excel::create('SaldosCartera'.$mytime,function($excel){
            $excel->sheet('Saldos',function($sheet){
                $saldosCartera =DB::select('SELECT cuenta, nombre, telCasa, telTrabajo, celular, saldo as saldoQ,saldoVencido as saldoVencidoQ, pagoMinimo as pagoMinimoQ,
                montoUltPago, fechaUltPago, fechaCorte, responsable, saldoD, saldoVencidoD, pagoMinimoD, montoUltPagoD, email
                from cliente  
                    where desasignado is null
                    order by responsable;
                    ');
            $saldosCartera= json_decode( json_encode($saldosCartera), true);
            $sheet->fromArray($saldosCartera);                   
            });    
        
        })->export('xls');
    }


   // Reporte de cuentas por estado (gestionado, cobrado, etc) 
   public function excel4 (){
    $mytime=Carbon::now()->toDateTimeString(); 
    Excel::create('Reporte_sumarizado_Ctas_por_estado'.$mytime,function($excel){
        $excel->sheet('Resumen_general',function($sheet){
            $saldosCartera =DB::select('SELECT IFNULL(t.descripcion,"NO GESTIONADO") AS Estado, COUNT(*) AS cantCuentas  
			FROM cliente c 
			LEFT JOIN gestion g ON c.ultGestion= g.idGestion  
			left join tipificacion t ON g.idTipif = t.id_tipif
			GROUP BY t.descripcion 	
			

            
                ');
        $saldosCartera= json_decode( json_encode($saldosCartera), true);
        $sheet->fromArray($saldosCartera);                   
        });    
    
    })->export('xls');
}
}
