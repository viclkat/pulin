@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Procedimientos <a href="/pprocedimiento/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('pprocedimiento.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Cliente</th>
					<th>Estado</th>
					<th>Operador Asignado</th>
					<th>Descripcion</th>
					<th>Valor</th>
					<th>Opciones</th>
				</thead>
				@foreach ($procedimientos as $rl)
				<tr>
					<td>{{$rl->id}}</td>
					<td>{{$rl->cliente}}</td>
					<td>{{$rl->estado}}</td>
					<td>{{$rl->operador}}</td>
					<td>{{$rl->descripcion}}</td>
					<td>{{$rl->valor}}</td>
					<td>
						<a href="{{URL::action('ProcedimientoController@edit', $rl->id)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$rl->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td> 
				</tr>
				@include('pprocedimiento.modal')
				@endforeach
			</table>
		</div>
		{{$procedimientos->render()}}
	</div>
</div>
@endsection