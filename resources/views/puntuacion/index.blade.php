@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Historial de Puntuaciones<a href="puntuacion/create"><button class="btn btn-success">Nuevo</button></a></h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Puntos por Registro</th>
					<th>Puntos por Trabajo Realizado</th>
					
				</thead>
				@foreach ($puntuacion as $rl)
				<tr>
					<td>{{$rl->id}}</td>
					<td>{{$rl->puntoporreg}}</td>
					<td>{{$rl->puntoportrab}}</td>
					 
				</tr>
				@endforeach
			</table>
		</div>
		{{$puntuacion->render()}}
	</div>
</div>
@endsection