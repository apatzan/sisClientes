<?php

namespace sisClientes\Http\Controllers;

use Illuminate\Http\Request;

use sisClientes\Http\Requests;
use DB;

class asignacionController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
        
	}
	
    public function index()
    {


     return view('carga.asignacion.index'); 
     }


       public function import (Request $request)
    {



    	$filename =  $request->file('select_file')->getRealPath();


// Función anterior, se ha mejorado para procesar los registros 1 a 1 
/*
		$data="LOAD DATA LOCAL INFILE '".$filename."' REPLACE INTO TABLE  act_asignacion FIELDS TERMINATED BY '|' LINES TERMINATED BY '\n'";	

		$pdo = DB::connection()->getPdo();
		$pdo->exec($data);
		
*/

		$count = 0;
		$lines =0;
		$file =fopen($filename, "r");
		$numbOfLines = count(file($filename))-1;  // El archivo que procesa GLB tiene una linea extra, obtengo el numero de lineas y quito la linea vacia
		while(!feof($file) and $lines <$numbOfLines){
			
			$content =fgets($file);
			$carray=explode("	", $content);
			if ($count >0 )  // Exclusión de los encabezados
			{		
			$cuenta=$carray[0];
			$gestor=$carray[1];
			
			//$contraReserva=$carray[55];
	

			$query = DB::insert('insert into `tmp_asignacion` (`cuenta`,
						`gestor`) values(?,?)',
				[$cuenta,
				 $gestor]);

						$lines++;
			}
			else {
				$count = 1;
			}
			
					}

			fclose($file);
			
			DB::statement('call asignacion_manual()');

			$request->session()->flash('report', 'Asignación procesada con éxito');
			return back();


    	 return view('carga.asignacion.index');
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