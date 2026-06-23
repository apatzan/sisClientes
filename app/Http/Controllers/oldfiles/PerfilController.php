<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use sisClientes\Perfil;
use Illuminate\Support\Facades\Redirect;
use sisClientes\Http\Requests\PerfilFormRequest;
use DB;


class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function index(Request $request)
    {
        if ($request)
        {
            $query=trim($request->get('searchText'));
            $perfiles=DB::table('perfiles')->where('descripcion','LIKE','%'.$query.'%')
            ->orderBy('idPerfil','desc')
            ->paginate(10);
            return view('seguridad.perfil.index',["perfiles"=>$perfiles,"searchText"=>$query]);
        }
    }
    
    public function create()
    {
        return view("seguridad.perfil.create");
    }
    public function store (PerfilFormRequest $request)
    {
        $perfil=new Perfil;
        $perfil->descripcion=$request->get('descripcion');
        $perfil->save();
        return Redirect::to('seguridad/perfil');
    }
    public function edit($id)
    {
        return view("seguridad.perfil.edit",["perfil"=>Perfil::findOrFail($id)]);
    }    
    public function update(PerfilFormRequest $request,$id)
    {
        $perfil=Perfil::findOrFail($id);
        $perfil->descripcion=$request->get('descripcion');
        $perfil->update();
        return Redirect::to('seguridad/perfil');
    }
    public function destroy($id)
    {
        $perfil = DB::table('perfiles')->where('idPerfil', '=', $id)->delete();
        return Redirect::to('seguridad/perfil');
    }
}
