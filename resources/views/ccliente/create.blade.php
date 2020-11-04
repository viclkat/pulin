@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'/ccliente','method'=>'POST', 'autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="nombre">Nombre*</label>
				<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
			</div>
			<div class="form-group">
				<label for="telefono">Telefono*</label>
				<input type="text" name="telefono" class="form-control" placeholder="Telefono...">
			</div>
			<div class="form-group">
				<label for="cedula">Cedula</label>
				<input type="text" name="cedula" class="form-control" placeholder="Cedula...">
			</div>
			<div class="form-group">
				<label for="email">Correo Electronico</label>
				<input type="text" name="email" class="form-control" placeholder="Correo Electronico...">
			</div>
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control" placeholder="Direccion...">
			</div>
			<div class="form-group">
				<p>*Los campos con (*) son obligatorios</p>
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection