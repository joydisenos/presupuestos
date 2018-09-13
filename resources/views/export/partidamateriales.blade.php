<table>
	@foreach($materiales as $material)
	<tr>
		<td>{{$material->partida->nombre}}</td>
		<td>{{$material->material->nombre}}</td>
		<td>{{$material->cantidad}}</td>
		<td>"{{$material->formula}}"</td>
		<td>
		@if($material->grupo_id != null)
			{{$material->grupo->nombre}}
		@endif
		</td>
	</tr>
	@endforeach
</table>