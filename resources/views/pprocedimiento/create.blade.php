@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Procedimiento</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'/pprocedimiento','method'=>'POST', 'autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="registro">Registro*</label>
				<select name="registro" class="form-control">
					@foreach ($registros as $reg)
						<option value="{{$reg->id}}">{{$reg->cliente}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="operador">Operador*</label>
				<select name="operador" class="form-control">
					@foreach ($operadores as $op)
						<option value="{{$op->id}}">{{$op->nombre}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" placeholder="Descripcion...">
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" name="valor" class="form-control" placeholder="Valor...">
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