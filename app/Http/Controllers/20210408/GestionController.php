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

class GestionController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
	}

     public function create($id){
        $tipificaciones=DB::table('tipificacion')->where('estado','=','1')->get();
        return view("cliente.gestion.create",["cliente"=>Cliente::FindOrFail($id),"tipificaciones"=>$tipificaciones]);

    }

    public function store(GestionFormRequest $request){
        $userIngreso = Auth::user()->email;

        $id=$request->get('idCliente');
        $gestion=new Gestion;
        $gestion->idCliente=$request->get('idCliente');
        $gestion->idTipif=$request->get('idTipif');
        $gestion->observacion=$request->get('observacion');
        $gestion->userIngreso=$userIngreso;
        
        $gestion->save();

         
        return Redirect::to('cliente/consulta/'.$id); 
    }

}
