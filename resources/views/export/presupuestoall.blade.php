<table>
	@foreach($presupuestos as $presupuesto)
	<tr>
		<td>{{$presupuesto->nombre}}</td>
		<td>{{$presupuesto->subtotal}}</td>
		<td>{{$presupuesto->total}}</td>
		<td>{{$presupuesto->estatus}}</td>
	</tr>
	@endforeach
</table>