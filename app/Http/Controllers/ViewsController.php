<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;

use Iluminate\Support\Facades\Redirect;
use Iluminate\Supporte\Facates\Input;
use sisClientes\Http\Requests\ViewsFormRequest;
use sisClientes\Cliente;
use sisClientes\Gestion;
use DB;
use Carbon\Carbon;
use Response;
use Iluminate\Support\Collection;

class ViewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    public function show()
    {

    return view("cliente.tipificacion.index");
    }


}
