<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use Iluminate\Support\Facades\Redirect;
use Iluminate\Supporte\Facates\Input;
use sisClientes\Http\Requests\PagoFormRequest;
use sisClientes\Pago;
use DB;

class PagoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(Request $request)
    {
        if ($request)
        {
            $year = date('Y');
            $month =date('m');
            $query=trim($request->get('searchText'));
            $name=trim($request->get('cuenta'));
            $pagos=DB::table('pagos')->where('cuenta','LIKE','%'.$query.'%')
            ->whereyear('fecha_pago','=',$year)
            ->wheremonth('fecha_pago','=',$month)
            ->orderBy('moneda','asc')
            ->paginate(50);
            return view('pago.consulta.index',["pagos"=>$pagos,"searchText"=>$query]);
        }
    }


}
