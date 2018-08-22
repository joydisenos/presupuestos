<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        
                                        <th>Mano de Obra</th>
                                        <th>Indirectos</th>
                                        <th>Total</th>
                                        
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($presupuesto->partidas as $partida)
                                    <tr>
                                    	<td>
                                    		{{$partida->partida->nombre}}
                                    	</td>
                           
                                        
                                    	<td>
                                    		{{$partida->partida->mano->nombre}}, ${{$partida->partida->mano->precio}}
                                    	</td>
                                    	<td>
                                    		{{$partida->partida->indirecto->nombre}}, ${{$partida->partida->indirecto->precio}}
                                    	</td>
                                    	<td>
                                    		$<span class="totalunit">{{$partida->partida->total}}</span>
                                            
                                    	</td>
                                        
                                        <td>
                                            {{$partida->cantidad}}
                                        </td>
                                        <td>
                                            $<span class="precios">{{$partida->cantidad * $partida->partida->total}}</span>
                                           
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="7" align="right">Subtotal</td>
                                        <td>$<span class="subtotal">{{$presupuesto->subtotal}}</span> </td>
                                        
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right">Iva ({{$configuraciones->iva}}%)</td>
                                        <td>$<span class="iva">{{($configuraciones->iva /100) * $presupuesto->subtotal}}</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right"><strong>Total</strong></td>
                                        <td><strong>$<span class="total">{{(($configuraciones->iva /100) * $presupuesto->subtotal) + $presupuesto->subtotal}}</span></strong></td>
                                        
                                    </tr>
                                    
                                    
                                </tbody>
                            </table>