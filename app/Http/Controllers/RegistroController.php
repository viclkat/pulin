<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Http\Requests;
use Ctapp\Cliente;
use Ctapp\UsuarioAux;
use Ctapp\User;
use Ctapp\Registro;
use Ctapp\Puntuacion;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\RegistroFormRequest;
use DB;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
    		$registros=DB::table('registros as r')
            ->join('clientes as c','r.cliente','=','c.id')
            ->join('usuarios as u','r.asesor','=','u.id')
            ->join('users as u3','u.iduser','=','u3.id')
            ->join('estadoregistros as e','r.estado','=','e.id')
            ->rightjoin('usuarios as u2','r.asignado','=','u2.id')
            ->join('users as u4','u2.iduser','=','u4.id')
            ->select('r.id','c.nombre as nombre','c.telefono as telefono','c.cedula as cedula','c.email as email','c.direccion as direccion','u3.name as asesor','e.nombre as estado','u4.name as asignado','r.Descripcion as descripcion')
            ->where('c.nombre','LIKE','%'.$query.'%')
    		->orderBy('r.id','desc')
    		->paginate(7);
    		return view('registro.index',["registros"=>$registros, "searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view('registro.create');
    }

    public function store(RegistroFormRequest $request)
    {
    	try {
            DB::beginTransaction();
            $cliente=new Cliente;
            $cliente->nombre=$request->get('nombre');
	    	$cliente->telefono=$request->get('telefono');
	    	$cliente->cedula=$request->get('cedula');
	    	$cliente->email=$request->get('email');
	    	$cliente->direccion=$request->get('direccion');
	    	$cliente->condicion='1';
	    	$cliente->save();
	    	$registro=new Registro;
	    	$registro->cliente=$cliente->id;
            $ass=DB::table('usuarios')->where('iduser','=',$request->get('asesor'))->value('id');
            $prro = $ass;
            $registro->asesor=$prro;
            $registro->estado='1';
            $registro->asignado='9';
            $registro->Descripcion=$request->get('descripcion');
            $registro->save();
            $user = User::findOrFail($request->get('asesor'));
            $pnt=Puntuacion::all();
            $pt=$pnt->last();
            $user->puntos=$user->puntos+$pt->puntoporreg;
            $user->update();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    	return Redirect::to('/registro');
    }

    public function edit($id)
    {
    	$cliente=DB::table('registros as r')
    	->join('clientes as c','r.cliente','=','c.id')
    	->select('r.id as id', 'c.nombre as nombre','c.telefono as telefono','c.cedula as cedula','c.email as email','c.direccion as direccion','r.asesor as asesor','r.estado as estado','r.Descripcion as descripcion')
    	->where('r.id','=',$id)->get();
    	$visitadores=DB::table('usuarios as u1')
    	->join('users as u2','u1.iduser','=','u2.id')
    	->select('u1.id', 'u2.name as name', 'u1.idrol as idrol')
    	->where('u1.idrol','=','4')->get();
    	$estados=DB::table('estadoregistros')->get();
    	return view('registro.edit', ["registro"=>Registro::findOrFail($id)])->with("visitadores", $visitadores)->with("cliente", $cliente)->with("estados", $estados);
    }

    public function update(RegistroFormRequest $request, $id)
    {
    	$registro=Registro::findOrFail($id);
    	$registro->estado=$request->get('estado');
    	$registro->asignado=$request->get('asignado');
    	$registro->Descripcion=$request->get('descripcion');
    	$registro->update();
    	$cliente=Cliente::findOrFail($registro->cliente);
    	$cliente->nombre=$request->get('nombre');
    	$cliente->telefono=$request->get('telefono');
    	$cliente->cedula=$request->get('cedula');
    	$cliente->email=$request->get('email');
    	$cliente->direccion=$request->get('direccion');
    	$cliente->update();
    	return Redirect::to('/registro');
    }

    public function destroy($id)
    {
    	$usu= DB::table('registros')->where('id','=',$id)->delete();
    	return Redirect::to('/registro');
    }
}
