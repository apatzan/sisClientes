<?php

namespace sisClientes;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    //
    public $timestamps=false;
    protected $table='perfiles';
    
    protected $primaryKey='idPerfil';
    protected $timestamp=false;

    protected $fillable = [
          'descripcion',
          
    ];

}