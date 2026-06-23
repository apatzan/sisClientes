<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;
use sisClientes\Http\Requests;
use sisClientes\User;
use Illuminate\Support\Facades\Redirect;
use sisClientes\Http\Requests\UsuarioFormRequest;
use DB;

class UsuarioController extends Controller
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
            $usuarios=DB::table('users as u ')->where('name','LIKE','%'.$query.'%')
            ->join('perfiles as p','u.perfil','=','p.idPerfil')
            ->orderBy('id','desc')
            ->paginate(10);
            return view('seguridad.usuario.index',["usuarios"=>$usuarios,"searchText"=>$query]);
        }
    }


    public function index2()
    {
  
        return view('layouts.index');
        }
    
    public function create()
    {
        $perfiles=DB::table('perfiles')->get();
        return view("seguridad.usuario.create",["perfiles"=>$perfiles]);
       //  return view("seguridad.usuario.create");
    }
    public function store (UsuarioFormRequest $request)
    {
        $usuario=new User;
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        $usuario->password=bcrypt($request->get('password'));
        $usuario->perfil=$request->get('idPerfil');
        $usuario->save();
        return Redirect::to('seguridad/usuario');
    }
    public function edit($id)
    {
        $perfiles=DB::table('perfiles')->get();        
        return view("seguridad.usuario.edit",["usuario"=>User::findOrFail($id)],["perfiles"=>$perfiles]);
    }    
    public function update(UsuarioFormRequest $request,$id)
    {
        $usuario=User::findOrFail($id);
        $usuario->name=$request->get('name');
        $usuario->email=$request->get('email');
        if ($request->get('idPerfil')!=null)
        {
        $usuario->perfil=$request->get('idPerfil');
    }
        $usuario->password=bcrypt($request->get('password'));
        $usuario->update();

        if ($usuario->perfil=="1")
        return Redirect::to('seguridad/usuario');
        else  
        return Redirect::to('home');
    }
    public function destroy($id)
    {
        $usuario = DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('seguridad/usuario');
    }
}
