<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Materiales</th>
                                        <th>Ver / Editar</th>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#materiales{{$partida->partida->id}}">
                                              Materiales
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{url('partida').'/'.$partida->id}}" class="btn btn-warning"> <i class="fa fa-eye"></i> </a>
                                        </td>
                                    	<td>
                                    		{{$partida->partida->mano->nombre}}, ${{$partida->partida->mano->precio}}
                                    	</td>
                                    	<td>
                                    		{{$partida->partida->indirecto->nombre}}, ${{$partida->partida->indirecto->precio}}
                                    	</td>
                                    	<td>
                                    		$<span class="totalunit">{{$partida->partida->total}}</span>
                                            <input type="hidden" name="item[]" class="totalpartida" value="{{$partida->partida->total}}">
                                    	</td>
                                        
                                        <td>
                                            <input type="number" min="0" step="0.01" class="form-control cantidades" name="cantidades[]" value="{{$partida->cantidad}}">
                                            <input type="hidden" name="partidas[]" value="{{$partida->id}}">
                                        </td>
                                        <td>
                                            $<span class="precios">{{$partida->cantidad * $partida->partida->total}}</span>
                                            <input type="hidden" class="preciosval" value="{{$partida->cantidad * $partida->partida->total}}">
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td colspan="7" align="right">Subtotal</td>
                                        <td>$<span class="subtotal">0</span> </td>
                                        
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right">Iva ({{$configuraciones->iva}}%)</td>
                                        <td>$<span class="iva">0</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="7" align="right"><strong>Total</strong></td>
                                        <td><strong>$<span class="total">0</span></strong></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="8" align="right">
                                            <button type="submit" class="btn btn-primary">
                                                Guardar
                                            </button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>