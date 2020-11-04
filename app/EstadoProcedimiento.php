<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class EstadoProcedimiento extends Model
{
    protected $table="estados";

    protected $primaryKey="id";

    public $timestamps="true";

    protected $fillable= [
    	'nombre',
    	'condicion'
    ];

    protected $guarded=[

    ];
}
