<table>
	@foreach($materiales as $material)
	<tr>
		<td>{{$material->partida->nombre}}</td>
		<td>{{$material->material->nombre}}</td>
		<td>{{$material->cantidad}}</td>
		<td>"{{$material->formula}}"</td>
	</tr>
	@endforeach
</table>