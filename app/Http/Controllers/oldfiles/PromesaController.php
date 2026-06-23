<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use Iluminate\Supporte\Facades\Input;
use sisClientes\Cliente;
use sisClientes\Gestion;
use Illuminate\Support\Facades\Redirect;
use sisClientes\Http\Requests\GestionFormRequest;
use DB;
use Auth;
use Carbon\Carbon;
use Response;
use Iluminate\Support\Collection;

class PromesaController extends Controller
{
    //
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
            $name=trim($request->get('usuario'));
            $todayDate = date("Y-m-d");

            $promesa=DB::table('gestion as g ')
            ->join('tipificacion as t','g.idTipif','=','t.id_Tipif')
            ->join('cliente as c','g.idCliente','=','c.id')
            ->select('g.idGestion','g.fecha','t.descripcion','g.observacion','g.fechaPromesa','c.id','c.nombre')
            ->where('nombre','LIKE','%'.$query.'%')
            ->where('c.responsable','=',$resp)
            ->where('t.esPromesa','=','S')
            ->where('g.fechaPromesa','=',$todayDate)
           ->orderBy('g.idGestion','desc')
           ->paginate(50);

            return view('cliente.promesa.index',["promesa"=>$promesa,"searchText"=>$query]);
        }
    }

     public function create($id){
        $tipificaciones=DB::table('tipificacion')->where('estado','=','1')->get();
        $tipificaciones=DB::table('tipificacion')->where('esPromesa','=','S')->get();
        return view("cliente.promesa.create",["cliente"=>Cliente::FindOrFail($id),"tipificaciones"=>$tipificaciones]);

    }

    public function store(GestionFormRequest $request){

        $id=$request->get('idCliente');
        $gestion=new Gestion;
        $gestion->idCliente=$request->get('idCliente');
        $gestion->idTipif=$request->get('idTipif');
        $gestion->observacion=$request->get('observacion');
        $gestion->fechaPromesa=$request->get('fechaPromesa');
        $gestion->save();

         
        return Redirect::to('cliente/consulta/'.$id); 
    }
}
