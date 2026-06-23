<?php

namespace sisClientes\Http\Controllers;

use sisClientes\Http\Requests;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
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
    public function index()
    {
        // Gestiones Mes 
        $gestionesMes=DB::select('SELECT u.name as nombre,ifnull(count(*),0) as CantGestiones from gestion g inner join users u on 
        g.UserIngreso=u.email where  year(g.fecha) = year(curdate()) and month(g.fecha) =month(curdate())  group by u.name');
  
        // Promesas Mes
        $promesasMes=DB::select('SELECT u.name as nombre,ifnull(count(*),0) as CantGestiones from gestion g 
				inner join users u ON  g.UserIngreso=u.email 
			 	INNER JOIN tipificacion t ON g.idTipif = t.id_tipif
				WHERE  year(g.fecha) = year(curdate()) AND month(g.fecha) =month(curdate())  group by u.name AND t.esPromesa="S"');
  
        // Pagos Mes
        $pagosMesQ=DB::select('SELECT REPLACE(REPLACE(c.responsable, CHAR(13), ""), CHAR(10), "") as responsable, round (sum(p.montoPago),2) as monto, p.moneda
                        from pagos p
                        inner join cliente c  on p.cuenta = c.cuenta AND c.moneda="Quetzales"  
                        where  year(p.fecha_pago) = year(curdate()) and month(p.fecha_pago) =month(curdate()) and p.moneda="320"
								group by REPLACE(REPLACE(c.responsable, CHAR(13), ""), CHAR(10), "")');
        
        // Pagos Mes Dolares 
        $pagosMesD=DB::select('SELECT REPLACE(REPLACE(c.responsable, CHAR(13), ""), CHAR(10), "") as responsable, round (sum(p.montoPago),2) as monto, p.moneda
                        from pagos p
                        inner   join cliente c  on p.cuenta = c.cuenta 
                        where  year(p.fecha_pago) = year(curdate()) and month(p.fecha_pago) =month(curdate()) and p.moneda="840"
								group by REPLACE(REPLACE(c.responsable, CHAR(13), ""), CHAR(10), "");');                             
     
     // $gestiones=DB::select('SELECT monthname(fecha) as nombre, info as CantGestiones from tmp_data');   
        return view('home',["gestiones"=>$gestionesMes,"pagos"=>$pagosMesQ,"pagosD"=>$pagosMesD,"promesas"=>$promesasMes]);
        }


}
