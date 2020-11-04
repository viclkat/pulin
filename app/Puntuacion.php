<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class Puntuacion extends Model
{
    protected $table="puntuacion";

    protected $primaryKey="id";

    public $timestamps="true";

    protected $fillable= [
    	'puntoporreg',
    	'puntoportrab'
    ];

    protected $guarded=[

    ];
}
