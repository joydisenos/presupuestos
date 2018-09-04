<table>
	@foreach($materiales as $material)
	<tr>
		<td>{{$material->presupuestopartida->partida->nombre}}</td>
		<td>{{$material->presupuestopartida->presupuesto->nombre}}</td>
		<td>{{$material->material->nombre}}</td>
		<td>{{$material->cantidad}}</td>
		<td>{{$material->cantidad_partida}}</td>
		<td>"{{$material->formula}}"</td>
	</tr>
	@endforeach
</table>