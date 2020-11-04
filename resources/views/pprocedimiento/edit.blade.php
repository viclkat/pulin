@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Procedimiento: {{$procedimiento->id}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($procedimiento,['method'=>'PATCH','route'=>['pprocedimiento.update', $procedimiento->id]])!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="registro">Registro*</label>
				<select name="registro" class="form-control" readonly>
					@foreach ($registros as $reg)
						@if ($reg->id==$procedimiento->registro)
							<option value="{{$reg->id}}" selected>{{$reg->cliente}}</option>
						@else
							<option value="{{$reg->id}}">{{$reg->cliente}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="estado">Estado</label>
				<select name="estado" class="form-control">
					@foreach ($estados as $est)
						@if ($est->id==$procedimiento->estado)
							<option value="{{$est->id}}" selected>{{$est->nombre}}</option>
						@else
							<option value="{{$est->id}}">{{$est->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="operador">Operador*</label>
				<select name="operador" class="form-control">
					@foreach ($operadores as $op)
						@if ($op->id==$procedimiento->operador)
							<option value="{{$op->id}}" selected>{{$op->nombre}}</option>
						@else
							<option value="{{$op->id}}">{{$op->nombre}}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" class="form-control" value="{{$procedimiento->descripcion}}" placeholder="Descripcion...">
			</div>
			<div class="form-group">
				<label for="valor">Valor</label>
				<input type="text" name="valor" class="form-control" value="{{$procedimiento->valor}}"placeholder="Valor...">
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