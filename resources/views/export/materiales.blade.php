<table>
	<tr>
		<td colspan="5"><h1>Presupuesto: {{$presupuesto->nombre}}</h1></td>
	</tr>
	@foreach($presupuesto->partidas as $partida)
	<tr>
		<td colspan="5">Partida: {{$partida->partida->nombre}}</td>
	</tr>
	<tr>
		<td>Nombre</td>
		<td>Tipo</td>
		<td>Precio</td>
		<td>Cantidad</td>
		<td>Total</td>
	</tr>
		<?php $totalmaterialunitario = 0; ?>
        @foreach($partida->materiales as $material)
        <?php $totalmaterialunitario += ($material->cantidad * $material->material->precio); ?>
        <tr>
            <td>{{$material->material->nombre}}</td>
            <td>{{$material->material->tipo}}</td>
            <td>${{$material->material->precio}}</td>
            <td>{{$material->cantidad}}</td>
            <td>${{$material->cantidad * $material->material->precio}}</td>
        </tr>    
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>SubTotal</strong></td>
            <td><strong>${{$totalmaterialunitario}}</strong></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->mano->nombre}}</td>
            <td>Mano de Obra ({{$partida->mano->precio}}%)</td>
            <td>${{$totalmaterialunitario * ($partida->mano->precio / 100)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->indirecto->nombre}}</td>
            <td>Indirecto ({{$partida->indirecto->precio}}%)</td>
            <td>${{$totalmaterialunitario * ($partida->indirecto->precio / 100)}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total Unitario</strong></td>
            <td><strong>${{
                ($totalmaterialunitario * ($partida->indirecto->precio / 100))
                +
                ($totalmaterialunitario * ($partida->mano->precio / 100))
                +
                $totalmaterialunitario

            }}</strong></td>
        </tr>
         <tr>
            <td></td>
            <td></td>
            <td>{{$partida->mano->nombre}}</td>
            <td>Mano de Obra ({{$partida->mano->precio}}%) (cantidad partidas: {{$partida->cantidad}})</td>
            <td>${{($totalmaterialunitario * ($partida->mano->precio / 100))* $partida->cantidad}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>{{$partida->indirecto->nombre}}</td>
            <td>Indirecto ({{$partida->indirecto->precio}}%) (cantidad partidas: {{$partida->cantidad}})</td>
            <td>${{($totalmaterialunitario * ($partida->indirecto->precio / 100))* $partida->cantidad}}</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><strong>Total (cantidad partidas: {{$partida->cantidad}})</strong></td>
            <td><strong>${{
                (
                ($totalmaterialunitario * ($partida->indirecto->precio / 100))
                +
                ($totalmaterialunitario * ($partida->mano->precio / 100))
                +
                $totalmaterialunitario
                ) 
                *
                $partida->cantidad

            }}</strong></td>
        </tr>
	@endforeach
</table>