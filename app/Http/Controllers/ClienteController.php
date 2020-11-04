<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Cliente;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\ClienteFormRequest;
use DB;

class ClienteController extends Controller
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
    		$clientes=DB::table('clientes')->where('nombre','LIKE', '%'.$query.'%')->where('condicion','=','1')->orderBy('id','desc')->paginate(7);
    		return view('ccliente.index',["clientes"=>$clientes, "searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("ccliente.create");
    }
    public function store(ClienteFormRequest $request)
    {
    	$cliente=new Cliente;
    	$cliente->nombre=$request->get('nombre');
    	$cliente->telefono=$request->get('telefono');
    	$cliente->cedula=$request->get('cedula');
    	$cliente->email=$request->get('email');
    	$cliente->direccion=$request->get('direccion');
    	$cliente->condicion='1';
    	$cliente->save();
    	return Redirect::to('/ccliente');
    }
    public function show($id)
    {
    	return view("ccliente.show", ["cliente"=>Cliente::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("ccliente.edit", ["cliente"=>Cliente::findOrFail($id)]);
    }
    public function update(ClienteFormRequest $request, $id)
    {
    	$cliente=Cliente::findOrFail($id);
    	$cliente->nombre=$request->get('nombre');
    	$cliente->telefono=$request->get('telefono');
    	$cliente->cedula=$request->get('cedula');
    	$cliente->email=$request->get('email');
    	$cliente->direccion=$request->get('direccion');
    	$cliente->update();
    	return Redirect::to('/ccliente');
    }
    public function destroy($id)
    {
    	$cliente=Cliente::findOrFail($id);
    	$cliente->condicion='0';
    	$cliente->update();
    	return Redirect::to('/ccliente');
    }
}
