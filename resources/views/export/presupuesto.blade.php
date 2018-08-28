<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead style="background: #ececec;">
                                    <tr>
                                       
                                        <th>Número</th>
                                        <th>Nombre</th>
                                        <th>T. Materiales</th>
                                        <th>Mano de Obra</th>
                                        <th>Mano de Obra (%)</th>
                                        <th>Indirectos</th>
                                        <th>Indirectos(%)</th>
                                        <th>Subtotales</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $materialGlobal = 0; ?>
                                    <?php $indirectoGlobal = 0; ?>
                                    <?php $manoGlobal = 0; ?>
                                    <?php $subtotalGlobal = 0; ?>
                                    @foreach($presupuesto->partidas  as $numero => $partida)
                                    <tr>
                                       
                                        <td>
                                            {{$partida->numero}}
                                        </td>
                                        <td>
                                            {{$partida->partida->nombre}}
                                        </td>
                                       
                                        <td>
                                            <?php $total = 0; ?>
                                            @foreach($partida->materiales as $material)
                                            <?php 
                    $total += $material->cantidad * $material->material->precio; 
                    $materialGlobal += ($material->cantidad * $material->material->precio) * $partida->cantidad; 
                    ?>
                                            @endforeach
                                            $<span class="tmaterial">{{$total}}</span>
                                        </td>
                                        <td>
                                            {{$partida->mano->nombre}}
                                        </td>
                                        <td>
                                            {{$partida->mano->precio}}%
                                            <?php 
$manoGlobal += (($partida->mano->precio / 100) * $total) * $partida->cantidad;
                                             ?>
                                        </td>
                                        <td>
                                          {{$partida->indirecto->nombre}}
                                        </td>
                                        <td>
                                            {{$partida->indirecto->precio}}%
                                            <?php 
$indirectoGlobal += (($partida->indirecto->precio / 100) * $total) * $partida->cantidad;
                                             ?>
                                        </td>
                                        <td>
                                            ${{$total}}
                                        </td>
                                        
                                        <td>
                                             {{$partida->cantidad}}
                                        </td>
                                        <td>
                                            <?php 
    $subtotales = ($partida->total_materiales + (($partida->mano->precio / 100) * $partida->total_materiales) + (($partida->indirecto->precio /100) * $partida->total_materiales)) * $partida->cantidad ;
    $subtotalGlobal += $subtotales;
    ?>
$<span class="precios">{{
    
    $subtotales

}}</span>

                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        
                                        <td>
                                            $<span class="materialesglobal">{{$materialGlobal}}</span>
                                        </td>
                                        <td></td>
                                        <td>$<span class="manoglobal">{{$manoGlobal}}</span></td>
                                        <td></td>
                                        <td>$<span class="indirectoglobal">{{$indirectoGlobal}}</span></td>
                                        <td></td>
                                        <td></td>   
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="9" align="right">Subtotal</td>
                                        <td>$<span class="subtotal">{{$subtotalGlobal}}</span> </td>
                                        
                                    </tr>

                                    <tr>
                                        <td colspan="9" align="right">Iva ({{$configuraciones->iva}}%)</td>
                                        <td>$<span class="iva">{{
        ($configuraciones->iva / 100) * $subtotalGlobal
                                    }}</span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="9" align="right"><strong>Total</strong></td>
                                        <td><strong>$<span class="total">
{{(($configuraciones->iva / 100) * $subtotalGlobal) + $subtotalGlobal}}
                                        </span></strong></td>
                                        
                                    </tr>
                                  
                                    
                                </tbody>
                            </table>