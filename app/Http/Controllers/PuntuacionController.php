<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Puntuacion;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\PuntuacionFormRequest;
use DB;

class PuntuacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		//$query=trim($request->get('searchText'));
    		$puntuacion=DB::table('puntuacion')->orderBy('id','desc')->paginate(7);
    		return view('puntuacion.index',["puntuacion"=>$puntuacion]);
    	}
    }
    public function create()
    {
    	return view("puntuacion.create");
    }
    public function store(PuntuacionFormRequest $request)
    {
    	$pnt=new Puntuacion;
    	$pnt->puntoporreg=$request->get('puntoporreg');
    	$pnt->puntoportrab=$request->get('puntoportrab');
    	$pnt->save();
    	return Redirect::to('puntuacion');
    }
    public function show($id)
    {
    	return view("puntuacion.show", ["pnt"=>Puntuacion::findOrFail($id)]);
    }
    public function edit($id)
    {
    	return view("puntuacion.rol.edit", ["pnt"=>Puntuacion::findOrFail($id)]);
    }
    public function update(PuntuacionFormRequest $request, $id)
    {
    	$pnt=Puntuacion::findOrFail($id);
    	$pnt->puntoporreg=$request->get('puntoporreg');
    	$pnt->puntoportrab=$request->get('puntoportrab');
    	$pnt->update();
    	return Redirect::to('puntuacion');
    }
    public function destroy($id)
    {
    	return Redirect::to('puntuacion');
    }
}
