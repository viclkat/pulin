<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registros';

    protected $primaryKey = 'id';

    public $timestamps="false";

    protected $fillable = [
        'cliente','asesor','estado','asignado','Descripcion'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
