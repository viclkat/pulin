<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class EstadoCliente extends Model
{
    protected $table="estadoregistros";

    protected $primaryKey="id";

    public $timestamps="true";

    protected $fillable= [
    	'nombre',
    	'condicion'
    ];

    protected $guarded=[

    ];
}
