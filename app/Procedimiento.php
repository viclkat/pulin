<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    protected $table="procedimientos";

    protected $primaryKey="id";

    public $timestamps="true";

    protected $fillable= [
    	'registro',
    	'estado',
    	'operador',
    	'descripcion',
    	'valor',
    	'condicion'
    ];

    protected $guarded=[

    ];
}
