@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Registro Nº: {{$registro->id}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($registro,['method'=>'PATCH','route'=>['registro.update', $registro->id]])!!}
			{!!Form::token()!!}
			@foreach($cliente as $cl)
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{$cl->nombre}}" placeholder="Nombre...">
			</div>
			<div class="form-group">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" class="form-control" value="{{$cl->telefono}}" placeholder="Telefono...">
			</div>
			<div class="form-group">
				<label for="cedula">Cedula</label>
				<input type="text" name="cedula" class="form-control" value="{{$cl->cedula}}" placeholder="Cedula...">
			</div>
			<div class="form-group">
				<label for="email">Correo Electronico</label>
				<input type="text" name="email" class="form-control" value="{{$cl->email}}" placeholder="Correo Electronico...">
			</div>
			<div class="form-group">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" class="form-control" value="{{$cl->direccion}}" placeholder="Direccion...">
			</div>
			<div class="form-group">
                <label for="estado" class="col-md-4 control-label">Estado</label>
                <div class="col-md-12">
                    <select name="estado" class="form-control">
                        @foreach ($estados as $op)
                        	@if ($op->id==$registro->estado)
                            	<option value="{{$op->id}}" selected>{{$op->nombre}}</option>
                            @else
                            	<option value="{{$op->id}}">{{$op->nombre}}</option>
                        	@endif
                        @endforeach
                    </select>
                </div>
            </div>			
			@endforeach
			<div class="form-group">
                <label for="asignado" class="col-md-4 control-label">Visitador Asignado</label>
                <div class="col-md-12">
                    <select name="asignado" class="form-control">
                        @foreach ($visitadores as $op)
                            @if ($op->id==$registro->asignado)
                            	<option value="{{$op->id}}" selected>{{$op->name}}</option>
                            @else
                            	<option value="{{$op->id}}">{{$op->name}}</option>
                        	@endif
                        @endforeach
                    </select>
                </div>
            </div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>
@endsection