<table>
	@foreach($grupos as $material)
	<tr>
		<td>{{$material->material->nombre}}</td>
		<td>{{$material->grupo->nombre}}</td>
		<td>"{{$material->formula}}"</td>
		<td>{{$material->cantidad}}</td>
	</tr>
	@endforeach
</table>