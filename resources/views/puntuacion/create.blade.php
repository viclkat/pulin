@extends ('layouts.admin')
@section ('contenido')
<script>
    $(document).ready(function (){
      $('.solo-numero').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      });
    });
</script>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Cambiar Puntuacion</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'puntuacion','method'=>'POST', 'autocomplete'=>'off'))!!}
			{!!Form::token()!!}
			<div class="form-group">
				<label for="puntoporreg">Puntos por Registro</label>
				<input type="number" class="solo-numero" name="puntoporreg" class="form-control" placeholder="0">
			</div>
			<div class="form-group">
				<label for="puntoportrab">Puntos por Trabajo Realizado</label>
				<input type="number" class="solo-numero" name="puntoportrab" class="form-control" placeholder="0">
			</div>
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
			</div>

			{!!Form::close()!!}
		</div>
	</div>


@endsection