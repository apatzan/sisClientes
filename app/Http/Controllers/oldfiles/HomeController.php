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
        $gestiones=DB::select('SELECT u.name as nombre,ifnull(count(*),0) as CantGestiones from gestion g inner join users u on 
        g.UserIngreso=u.email where  year(g.fecha) = year(curdate()) and month(g.fecha) =month(curdate()) group by u.name');
  
  $pagos=DB::select('SELECT c.responsable as responsable, round (sum(p.montoPago),2) as monto
                        from pagos p
                        inner join cliente c on case when p.moneda ="320" then "Quetzales" else "Dolares" end = c.moneda and p.cuenta = c.cuenta
                        where  year(p.fecha_pago) = year(curdate()) and month(p.fecha_pago) =month(curdate())
                        group by c.responsable'); 
     
     // $gestiones=DB::select('SELECT monthname(fecha) as nombre, info as CantGestiones from tmp_data');   
        return view('home',["gestiones"=>$gestiones,"pagos"=>$pagos]);
        }


}
