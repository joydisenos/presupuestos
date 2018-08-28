<table>
	<tr>
		<td>Material</td>
		<td>Cantidad Global</td>
		<td>Unidad</td>
		<td>Precio Unitario</td>
		<td>Total</td>
	</tr>
	
		@foreach($materiales as $material)
		<tr>
               <td>{{$material->material->nombre}} </td>
               <td>{{$material->total_cantidades}} </td>
               <td>{{$material->material->tipo}} </td>
               <td>${{$material->material->precio}} </td>
               <td>${{$material->material->precio * $material->total_cantidades}} </td>
        </tr>
		@endforeach

</table>