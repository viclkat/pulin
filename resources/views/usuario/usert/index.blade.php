@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Usuarios <a href="/usuario/usert/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('usuario.usert.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Email</th>
					<th>Rol</th>
					<th>Opciones</th>
				</thead>
				@foreach ($usuarioss as $rl)
				<tr>
					<td>{{$rl->id}}</td>
					<td>{{$rl->nombre}}</td>
					<td>{{$rl->email}}</td>
					<td>{{$rl->rol}}</td>
					<td>
						<a href="{{URL::action('UsuarioAuxController@edit', $rl->id)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$rl->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td> 
				</tr>
				@include('usuario.usert.modal')
				@endforeach
			</table>
		</div>
		{{$usuarioss->render()}}
	</div>
</div>
@endsection