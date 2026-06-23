<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use sisClientes\Tipificacion;
use Illuminate\Support\Facades\Redirect;
use sisClientes\Http\Requests\TipificacionFormRequest;
use DB;
class TipificacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

	public function index(Request $Request){

		if ($Request){
			$query=trim($Request->get('searchText'));
			$tipificaciones=DB::table('tipificacion')->where('descripcion','LIKE','%'.$query.'%')
			->where('estado','=','1')
			->orderBy('id_tipif','asc')
			->paginate(7);
			return view('gestion.tipificacion.index',["tipificaciones" =>$tipificaciones,"searchText"=>$query]);
		}

	}

	public function create(){
		return view("gestion.tipificacion.create");

	}

	public function store(TipificacionFormRequest $request){

		$tipificacion=new Tipificacion;
		$tipificacion->descripcion=$request->get('descripcion');
		$tipificacion->estado=$request->get('estado');
		$tipificacion->esPromesa=$request->get('esPromesa');
		$tipificacion->save();
		return Redirect::to('gestion/tipificacion'); 
	}

	public function show ($id){
		return view ("gestion.tipificacion.show",["tipificacion"=>Tipificacion::findOrFail($id)]);
	}

    public function edit ($id){

    	return view ("gestion.tipificacion.edit",["tipificacion"=>Tipificacion::findOrFail($id)]);
    }

    public function update(TipificacionFormRequest $request, $id){
    	$tipificacion=Tipificacion::findOrFail($id);
    	$tipificacion->descripcion=$request->get('descripcion');
		$tipificacion->estado=$request->get('estado');
		$tipificacion->esPromesa=$request->get('esPromesa');
    	$tipificacion->update();
    	return Redirect::to('gestion/tipificacion');

    }

    public function destroy ($id){
    	$tipificacion=Tipificacion::findOrFail($id);
    	$tipificacion->estado='0';
    	$tipificacion->update();
    	return Redirect::to('gestion/tipificacion');


    }

}
