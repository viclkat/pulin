<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\EstadoProcedimiento;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\EstadoProcedimientoFormRequest;
use DB;
class EstadoProcedimientoController extends Controller
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
    		$estadosp=DB::table('estados')->where('nombre','LIKE', '%'.$query.'%')->where('condicion','=','1')->orderBy('id','desc')->paginate(7);
    		return view('estado.procedimiento.index',["estadosp"=>$estadosp, "searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("estado.procedimiento.create");
    }
    public function store(EstadoProcedimientoFormRequest $request)
    {
    	$estadop=new EstadoProcedimiento;
    	$estadop->nombre=$request->get('nombre');
    	$estadop->condicion='1';
    	$estadop->save();
    	return Redirect::to('/estado/procedimiento');
    }
    public function show($id)
    {
    	return view("estado.procedimiento.show", ["estadop"=>EstadoProcedimiento::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("estado.procedimiento.edit", ["estadop"=>EstadoProcedimiento::findOrFail($id)]);
    }
    public function update(EstadoProcedimientoFormRequest $request, $id)
    {
    	$estadop=EstadoProcedimiento::findOrFail($id);
    	$estadop->nombre=$request->get('nombre');
    	$estadop->update();
    	return Redirect::to('/estado/procedimiento');
    }
    public function destroy($id)
    {
    	$estadop=EstadoProcedimiento::findOrFail($id);
    	$estadop->condicion='0';
    	$estadop->update();
    	return Redirect::to('/estado/procedimiento');
    }
}
