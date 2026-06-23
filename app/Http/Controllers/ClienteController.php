<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;
use sisClientes\Http\Requests;

use Iluminate\Support\Facades\Redirect;
use Iluminate\Supporte\Facates\Input;
use sisClientes\Http\Requests\ClienteFormRequest;
use sisClientes\Cliente;
use sisClientes\Gestion;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Response;
use Iluminate\Support\Collection;

class ClienteController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request)
        {
            $responsable=Auth::user()->name;
            $arr = explode(" ", $responsable, 2);
            $resp = $arr[0];


            $query=trim($request->get('searchText'));
            $query2=trim($request->get('cuenta'));
            $query3=trim($request->get('numDocumento'));
            $query4=trim($request->get('telefono'));
            $name=trim($request->get('usuario'));
            $desasignado ='1';
            $clientes=DB::table('cliente')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('cuenta','LIKE','%'.$query2.'%')
            ->where('numDocumento','LIKE','%'.$query3.'%')
            ->where(function($tel) use ($query4){
                $tel->where('telcasa', 'LIKE', '%'.$query4.'%')
                      ->orWhere('teltrabajo', 'LIKE', '%'.$query4.'%')
                      ->orWhere('celular', 'LIKE', '%'.$query4.'%');})

            ->where('responsable','LIKE',$resp.'%')
			->where ('desasignado','=',null)
            ->orderBy('prioridad','asc')
            ->orderBy('fechaPromesa','asc')
            ->orderBy('horaRecordatorio','asc')
            ->orderBy('ultGestion','asc')
            ->paginate(50);
            return view('cliente.consulta.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);
        }
    }

    public function clientes(Request $request)
    {
        if ($request)
        {


            $query=trim($request->get('searchText'));
            $query2=trim($request->get('cuenta'));
            $query3=trim($request->get('numDocumento'));
            $query4=trim($request->get('telefono'));


            if ($query !=null)
            {
                $clientes=DB::table('cliente')
            
                ->where('nombre','LIKE','%'.$query.'%')
                ->orwhere('cuenta','=',$query2)
                ->orderBy('prioridad','asc')
                ->paginate(50);
                return view('cliente.general.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);   
               
            }else if ($query2!=null) {
                $clientes=DB::table('cliente')
                ->where('cuenta','=',$query2)
                ->orderBy('prioridad','asc')
                ->paginate(50);
                return view('cliente.general.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);

            }
            
            
            else if($query3!=null){
                $clientes=DB::table('cliente')
            
                ->where('numDocumento','LIKE','%'.$query3.'%')
                ->orderBy('prioridad','asc')
                ->paginate(50);
                return view('cliente.general.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);   

            }
            
            
            else if ($query4!=null){
                $clientes=DB::table('cliente')
            
                // ->where('numDocumento','=','DOCUMENTOS')
                ->where('telcasa','=',$query4)
                ->orwhere('telTrabajo','=',$query4)
                ->orwhere('celular','=',$query4)
                ->orderBy('prioridad','asc')
                ->paginate(50);
                return view('cliente.general.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);   


            }else{
                $clientes=DB::table('cliente')
            
                ->where('numDocumento','=','DOCUMENTOS')
                
                ->paginate(50);
                return view('cliente.general.index',["clientes"=>$clientes,"searchText"=>$query,"cuenta"=>$query2,"numDocumento"=>$query3,"telefono"=>$query4]);   

            }
        }
    }   

public function show($id)
{
    // Objeto Gestion
    $gestion = DB::table('gestion as g')
        ->join('tipificacion as t', 'g.idTipif', '=', 't.id_Tipif')
        ->join('cliente as c', 'g.idCliente', '=', 'c.id')
        ->select('g.idGestion', 'g.fecha', 't.descripcion', 'g.observacion', 'g.fechaPromesa', 'g.horaRecordatorio', 'g.userIngreso')
        ->where('g.idCliente', '=', $id)
        ->orderBy('g.idGestion', 'desc')
        ->get();

    // Tipificaciones
    $tipificaciones = DB::table('tipificacion')
        ->where('estado', '=', '1')
            ->get();

    // Cliente actual
    $clienteActual = Cliente::findOrFail($id);

    // Obtener todos los clientes ordenados (mismo orden de tu tabla, puedes ajustar)
    $responsable=Auth::user()->name;
            $arr = explode(" ", $responsable, 2);
            $resp = $arr[0];

    $clientesOrdenados = Cliente::where('responsable', 'LIKE', $resp . '%')
        ->whereNull('desasignado')
        ->orderBy('prioridad', 'asc')
        ->orderBy('fechaPromesa', 'asc')
        ->orderBy('horaRecordatorio', 'asc')
        ->orderBy('ultGestion', 'asc')
        ->get();


    // Buscar el índice del cliente actual en la lista ordenada
    $indiceActual = $clientesOrdenados->search(function ($cliente) use ($id) {
        return $cliente->id == $id;
    });

    // Buscar el siguiente cliente, si existe
    $clienteSiguiente = null;
    if ($indiceActual !== false && $indiceActual + 1 < $clientesOrdenados->count()) {
        $clienteSiguiente = $clientesOrdenados[$indiceActual + 1];
    }

    return view("cliente.consulta.details", [
        "cliente" => $clienteActual,
        "gestion" => $gestion,
        "tipificaciones" => $tipificaciones,
        "clienteSiguiente" => $clienteSiguiente, // <- lo mandamos a la vista
    ]);
}

    public function export_clientes (){
        // Pendiente agregar la fecha 
        $mytime=Carbon::now()->toDateTimeString();
        

        Excel::create('Cartera_gestor'.$mytime,function($excel){
            $excel->sheet('My Cartera',function($sheet){
                $responsable=Auth::user()->name;
                $arr = explode(" ", $responsable, 2);
                $resp = $arr[0];    
                $cuentas=DB::table('cliente as cl')
                ->join('clasificacion_cartera as cc','cl.prioridad','=','cc.id')
                ->select('cl.cuenta as cuenta','cl.nombre as Nombres','cc.descripcion AS clasificacion')
               //  ->where('cl.responsable','=',$resp)
				->where('cl.responsable','LIKE',$resp.'%')
                ->orderBy('cl.prioridad','asc')
                ->get();

            $cuentas= json_decode( json_encode($cuentas), true);
            $sheet->fromArray($cuentas);                   
            });    
        
        })->export('xls');
    }

}