<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use DB;

class desasignacionController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        
	}
	
    public function index()
    {


     return view('carga.desasignacion.index'); 
     }


       public function import (Request $request)
    {



    	$filename =  $request->file('select_file')->getRealPath();


		$count = 0;
		$lines =0;
		$file =fopen($filename, "r");
		$numbOfLines = count(file($filename))-1;  // $numbOfLines = count(file($filename))-1;
		while(!feof($file) and $lines <$numbOfLines){
			
			$content =fgets($file);
			$carray=explode("	", $content);
			if ($count >0 )  // Exclusión de los encabezados
			{		
			$cuenta=$carray[0];
			
			
			//$contraReserva=$carray[55];
	

			$query = DB::insert('insert into `tmp_desasignacion` (`cuenta`) values(?)',
				[$cuenta]);

						$lines++;
			}
			else {
				$count = 1;
			}
			
					}

			fclose($file);
			
			DB::statement('call desasignacion_manual()');

			$request->session()->flash('report', 'Desasignación procesada con éxito');
			return back();


    	 return view('carga.desasignacion.index');
}
}

/*
DECLARE c_cuenta int;
DECLARE c_gestor varchar (60);
  
  DECLARE done INT DEFAULT 0;
  
  -- Asignación
   DECLARE gestor CURSOR FOR
      SELECT    
    cuenta,
    gestor
    from tmp_asignacion;
    
    DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;
    
    OPEN gestor;
    
     REPEAT
      FETCH gestor
      INTO c_cuenta,c_gestor;
      IF NOT done
      THEN
	  update cliente set responsable = c_gestor where cuenta =c_cuenta;
      END IF;
    UNTIL done
    END REPEAT;
   
    CLOSE gestor;
*/