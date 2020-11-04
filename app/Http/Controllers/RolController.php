<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Rol;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\RolFormRequest;
use DB;

class RolController extends Controller
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
    		$roles=DB::table('roles')->where('nombre','LIKE', '%'.$query.'%')->where('condicion','=','1')->orderBy('id','desc')->paginate(7);
    		return view('usuario.rol.index',["roles"=>$roles, "searchText"=>$query]);
    	}
    }
    public function create()
    {
    	return view("usuario.rol.create");
    }
    public function store(RolFormRequest $request)
    {
    	$rol=new Rol;
    	$rol->nombre=$request->get('nombre');
    	$rol->condicion='1';
    	$rol->save();
    	return Redirect::to('usuario/rol');
    }
    public function show($id)
    {
    	return view("usuario.rol.show", ["rol"=>Rol::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("usuario.rol.edit", ["rol"=>Rol::findOrFail($id)]);
    }
    public function update(RolFormRequest $request, $id)
    {
    	$rol=Rol::findOrFail($id);
    	$rol->nombre=$request->get('nombre');
    	$rol->update();
    	return Redirect::to('usuario/rol');
    }
    public function destroy($id)
    {
    	$rol=Rol::findOrFail($id);
    	$rol->condicion='0';
    	$rol->update();
    	return Redirect::to('usuario/rol');
    }
}
