<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table="roles";

    protected $primaryKey="id";

    public $timestamps="true";

    protected $fillable= [
    	'nombre',
    	'condicion'
    ];

    protected $guarded=[

    ];
}
