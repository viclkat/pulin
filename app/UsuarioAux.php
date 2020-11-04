<?php

namespace Ctapp;

use Illuminate\Database\Eloquent\Model;

class UsuarioAux extends Model
{
    protected $table = 'usuarios';

    protected $primaryKey = 'id';

    public $timestamps="false";

    protected $fillable = [
        'iduser', 'idrol',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
