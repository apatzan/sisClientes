<?php

namespace sisClientes;

use Illuminate\Database\Eloquent\Model;

class Tipificacion extends Model
{
    public $timestamps=false;

    protected $table='tipificacion';
    protected $primaryKey='id_tipif';
    public $timesstamps='false';
    protected $fillable =[
    	'descripcion',
    	'estado',
        'esPromesa',
        'codEspromesa'
    ];

	protected $guarded =[
	];

    public static function tipificaciones($id){
        return Tipificacion::where('id_tipif','=',$id)->get;
    }
    
}
