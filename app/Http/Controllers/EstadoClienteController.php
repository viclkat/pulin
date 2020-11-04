<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\EstadoCliente;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\EstadoClienteFormRequest;
use DB;

class EstadoClienteController extends Controller
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
    		$estadosc=DB::table('estadoregistros')->where('nombre','LIKE', '%'.$query.'%')->where('condicion','=','1')->orderBy('id','desc')->paginate(7);
    		return view('estado.cliente.index',["estadosc"=>$estadosc, "searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("estado.cliente.create");
    }
    public function store(EstadoClienteFormRequest $request)
    {
    	$estadoc=new EstadoCliente;
    	$estadoc->nombre=$request->get('nombre');
    	$estadoc->condicion='1';
    	$estadoc->save();
    	return Redirect::to('/estado/cliente');
    }
    public function show($id)
    {
    	return view("estado.cliente.show", ["estadoc"=>EstadoCliente::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("estado.cliente.edit", ["estadoc"=>EstadoCliente::findOrFail($id)]);
    }
    public function update(EstadoClienteFormRequest $request, $id)
    {
    	$estadoc=EstadoCliente::findOrFail($id);
    	$estadoc->nombre=$request->get('nombre');
    	$estadoc->update();
    	return Redirect::to('/estado/cliente');
    }
    public function destroy($id)
    {
    	$estadoc=EstadoCliente::findOrFail($id);
    	$estadoc->condicion='0';
    	$estadoc->update();
    	return Redirect::to('/estado/cliente');
    }
}
