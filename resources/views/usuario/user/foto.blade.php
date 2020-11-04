@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Subir o Cambiar Foto de: {{auth()->user()->name}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			<form action="/usuario/user/image" method="PATCH">
			
				<label for="imagen">Subir Imagen</label>
				<input type="file" name="imagen" class="form-control">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			
			</form>
		</div>
	</div>
@endsection