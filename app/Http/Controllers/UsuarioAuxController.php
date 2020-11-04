<?php

namespace Ctapp\Http\Controllers;

use Illuminate\Http\Request;
use Ctapp\Http\Requests;
use Ctapp\UsuarioAux;
use Ctapp\User;
use Illuminate\Support\Facades\Redirect;
use Ctapp\Http\Requests\UsuarioAuxFormRequest;
use DB;

class UsuarioAuxController extends Controller
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
    		$usuarios=DB::table('usuarios as u1')
            ->join('users as u2','u1.iduser','=','u2.id')
            ->join('roles as r','u1.idrol','=','r.id')
            ->select('u1.id','u2.name as nombre','u2.email as email','r.nombre as rol')
            ->where('u2.name','LIKE','%'.$query.'%')
    		->orderBy('u1.id','desc')
    		->paginate(7);
    		return view('usuario.usert.index',["usuarioss"=>$usuarios, "searchText"=>$query]);
    	}
    }

    public function create()
    {
    	$roles=DB::table('roles')->where('condicion','=','1')->get();
    	return view('usuario.usert.create',["roles"=>$roles]);
    }

    public function store(UsuarioAuxFormRequest $request)
    {
    	try {
            DB::beginTransaction();
            $usuario=new User;
            $usuario->name=$request->get('name');
            $usuario->email=$request->get('email');
            $usuario->password=bcrypt($request->get('password'));
            $usuario->save();
            $usu=new UsuarioAux;
            $usu->idrol=$request->get('rol');
            $usu->iduser=$usuario->id;
            $usu->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    	return Redirect::to('/usuario/usert');
    }

    public function edit($id)
    {
    	return view('usuario.usert.edit', ["usuario"=>UsuarioAux::findOrFail($id)]);
    }

    public function update(UsuarioAuxFormRequest $request, $id)
    {
    	$usuario=UsuarioAux::findOrFail($id);
    	$usuario->idrol=$request->get('rol');
    	$usuario->update();
    	return Redirect::to('/usuario/usert');
    }

    public function destroy($id)
    {
    	$u = UsuarioAux::findOrFail($id);
    	$idu=$u->iduser;
    	$usu= DB::table('usuarios')->where('id','=',$id)->delete();
    	$usuario = DB::table('users')->where('id','=',$idu)->delete();
    	return Redirect::to('/usuario/usert');
    }
}
