@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Usuario: {{$usuario->name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($usuario,['method'=>'PATCH','route'=>['usuario.usert.update', $usuario->id]])!!}
			{!!Form::token()!!}
                        <div class="form-group">
                            <label for="rol">Rol*</label>
                            <select name="rol" class="form-control">
                                    <option value="1">Administrador</option>
                                    <option value="2">Developer</option>
                                    <option value="3">Asesor</option>
                                    <option value="4">Visitador</option>
                                    <option value="5">Operador</option>
                            </select>
                        </div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection