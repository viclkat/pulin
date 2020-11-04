<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Procedimiento;
use Ctapp\Registro;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\ProcedimientoFormRequest;
use DB;

class ProcedimientoController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$procedimientos=DB::table('procedimientos as p')
    		->join('estados as e','p.estado','=','e.id')
    		->join('registros as r', 'p.registro','=','r.id')
    		->join('clientes as c', 'r.cliente', '=', 'c.id')
    		->join('usuarios as o', 'p.operador', '=', 'o.id')
    		->join('users as u','o.iduser','=','u.id')
    		->select('p.id','c.nombre as cliente','e.nombre as estado','u.name as operador','p.descripcion','p.valor')
    		->where('cliente','LIKE', '%'.$query.'%')->where('p.condicion','=','1')->orderBy('p.id','desc')->paginate(7);
    		return view('pprocedimiento.index',["procedimientos"=>$procedimientos, "searchText"=>$query]);
    	}
    }
    public function create()
    {
    	$estados=DB::table('estados')->where('condicion','=','1')->get();
    	$registros=DB::table('registros as r')->join('clientes as c', 'r.cliente', '=', 'c.id')
    	->select('r.id', 'c.nombre as cliente', 'r.estado')
    	->where('r.estado','=','2')->get();
    	$operadores=DB::table('usuarios as o')
    	->join('users as u','o.iduser','=','u.id')
    	->select('o.id as id','u.name as nombre')
    	->where('idrol','=','5')->get();
    	return view("pprocedimiento.create", ["estados"=>$estados, "registros"=>$registros, "operadores"=>$operadores]);
    }
    public function store(ProcedimientoFormRequest $request)
    {
    	$procedimiento=new Procedimiento;
    	$procedimiento->registro=$request->get('registro');
    	$procedimiento->estado='1';
    	$procedimiento->operador=$request->get('operador');
    	$procedimiento->descripcion=$request->get('descripcion');
    	$procedimiento->valor=$request->get('valor');
    	$procedimiento->condicion='1';
    	$procedimiento->save();
    	$cliente=Registro::findOrFail($procedimiento->registro);
    	$cliente->estado='3';
    	$cliente->save();
    	return Redirect::to('/pprocedimiento');
    }
    public function show($id)
    {
    	return view("pprocedimiento.show", ["procedimiento"=>Procedimiento::findOrFail($id)]);
    }
    public function edit($id)
    {
    	$procedimiento=Procedimiento::findOrFail($id);
    	$estados=DB::table('estados')->where('condicion','=','1')->get();
    	$registros=DB::table('registros as r')->join('clientes as c', 'r.cliente', '=', 'c.id')
        ->select('r.id', 'c.nombre as cliente', 'r.estado')->get();
    	$operadores=DB::table('usuarios as o')
    	->join('users as u','o.iduser','=','u.id')
    	->select('o.id as id', 'u.name as nombre')
    	->where('idrol','=','5')->get();
    	return view("pprocedimiento.edit", ["procedimiento"=>Procedimiento::findOrFail($id), "estados"=>$estados, "registros"=>$registros, "operadores"=>$operadores]);
    }
    public function update(ProcedimientoFormRequest $request, $id)
    {
    	$estado=$request->get('estado');
    	$reg=$request->get('registro');
    	if($estado=='2'){
    		$cliente=Registro::findOrFail($reg);
	    	$cliente->estado='4';
	    	$cliente->update();
    	}
    	$procedimiento=Procedimiento::findOrFail($id);
    	$procedimiento->registro=$reg;
    	$procedimiento->estado=$estado;
    	$procedimiento->operador=$request->get('operador');
    	$procedimiento->descripcion=$request->get('descripcion');
    	$procedimiento->valor=$request->get('valor');
    	$procedimiento->update();
    	/**/
    	return Redirect::to('pprocedimiento');
    }
    public function destroy($id)
    {
    	$procedimiento=Procedimiento::findOrFail($id);
    	$procedimiento->condicion='0';
    	$procedimiento->update();
    	$registro=Registro::findOrFail($procedimiento->registro);
    	$registro->estado='6';
    	$registro->update();
    	return Redirect::to('/pprocedimiento');
    }
}
