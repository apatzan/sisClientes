<?php

namespace sisClientes;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps=false;

    protected $table='cliente';
    protected $primaryKey='id';
    public $timesstamps='false';
    protected $fillable =[
    	
    	'telefonoCasa',
    	'telefonoTrabajo',
    	'celular'
    ];

	protected $guarded =[
	];
}
