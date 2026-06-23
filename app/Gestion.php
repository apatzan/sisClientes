<?php

namespace sisClientes;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
	public $timestamps=false;
	protected $table ='gestion';

	protected $primarykey='idGestion';
	protected $timestamp=false;
	



	 protected $fillable =[
	 	'idCliente',
	 	'itTipif',
	 //	'fecha',
		 'observacion',
		 'fechaPromesa',
		 'horaRecordatorio'
	 ];

//	 protected $guarded =[];
 }
