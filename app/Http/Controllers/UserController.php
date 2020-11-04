<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;

use Ctapp\Http\Requests;
use Ctapp\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Ctapp\Http\Requests\UserFormRequest;
use DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function foto()
    {
        return view('usuario.user.foto');
    }

    public function show($id)
    {
        return view('usuario.user.show', ["usuario"=>User::findOrFail($id)]);
    }

    public static function image($file, $id)
    {
        if(Input::hasFile($file)){
            $f=Input::file($file);
            $f->move(public_path().'/imagenes/fotos/',$f->getClientOriginalName());
            $user=User::findOrFail($id);
            $user->imagen=$f->getClientOriginalName();
            $user->update();
        }
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
    		$usuarios=DB::table('users')->where('name','LIKE','%'.$query.'%')
    		->orderBy('id','desc')
    		->paginate(7);
    		return view('usuario.user.index',["usuarios"=>$usuarios, "searchText"=>$query]);
    	}
    }

    public function create()
    {
    	return view('usuario.user.create');
    }

    public function store(UserFormRequest $request)
    {
    	$usuario=new User;
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
    	$usuario->save();
    	return Redirect::to('/usuario/user');
    }

    public function edit($id)
    {
    	return view('usuario.user.edit', ["usuario"=>User::findOrFail($id)]);
    }

    public function update(UserFormRequest $request, $id)
    {
    	$usuario=User::findOrFail($id);
    	$usuario->name=$request->get('name');
    	$usuario->email=$request->get('email');
    	$usuario->password=bcrypt($request->get('password'));
        if(Input::hasFile($request->get('imagen'))){
            $f=Input::file($request->get('imagen'));
            $f->move(public_path().'/imagenes/fotos/',$f->getClientOriginalName());
            $usuario->imagen=$f->getClientOriginalName();
        }
    	$usuario->update();
    	return Redirect::to('/usuario/user');
    }

    public function destroy($id)
    {
    	$usuario = DB::table('users')->where('id','=',$id)->delete();
    	return Redirect::to('/usuario/user');
    }
}
