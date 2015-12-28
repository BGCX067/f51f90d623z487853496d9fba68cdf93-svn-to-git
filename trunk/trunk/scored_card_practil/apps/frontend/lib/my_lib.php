<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of practil_lib
 *
 * @author USUARIO
 *
 * VERSION: 1.0
 */
class my_lib {

 public function returnData_indicadores($user,$indicator){

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(TreeScPeer::ID,$indicator[1]);
    $tree = TreeScPeer::doSelectOne($criterio_busqueda);

    $criterio_busqueda->clear();
    $criterio_busqueda->add(DataIndicadoresPeer::USER_ID,$user->getId());
//  $criterio_busqueda->add(DataIndicadoresPeer::PERIODO_ID,$tree->getPeriodoId());
    $criterio_busqueda->add(DataIndicadoresPeer::INDICADOR_ID,$indicator[0]);

    $list = DataIndicadoresPeer::doSelect($criterio_busqueda);
    
    $var = '{name:"'.$list[0]->getIndicatorsSc()->getTitulo().'",';
    $cantidad = 1;
   
    foreach($list as $data):

           if($cantidad==count($list)){
              $var=$var.'f'.$cantidad.':"'.$data->getData().'",';
              $var=$var.'idfecha'.$cantidad.':"'.$data->getId().'",}';
           }else{
              $var=$var.'f'.$cantidad.':"'.$data->getData().'",';
              //aca cambia depende la cantidad de registros....si hay uno solo validar(pediente)
              $var=$var.'idfecha'.$cantidad.':"'.$data->getId().'",';
           }
   $cantidad ++;
   endforeach;

    $var = substr($var, 0, strlen($var)-2).'}';
    return $var;
    
}

public function returnCol_names($user,$indicator){

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(TreeScPeer::ID,$indicator[1]);
    $tree = TreeScPeer::doSelectOne($criterio_busqueda);

    $criterio_busqueda->clear();
    $criterio_busqueda->add(DataIndicadoresPeer::USER_ID,$user->getId());
//  $criterio_busqueda->add(DataIndicadoresPeer::PERIODO_ID,$tree->getPeriodoId());
    $criterio_busqueda->add(DataIndicadoresPeer::INDICADOR_ID,$indicator[0]);
    $list =DataIndicadoresPeer::doSelect($criterio_busqueda);

  // ['Id','Fecha1', 'Fecha 2', 'Fecha 3']

     $var = "['Descripcion','";
     $cantidad = 1;
        foreach($list as $data):
             $var=$var."Fecha-".$cantidad."','idfecha".$cantidad."','";
          $cantidad ++;
         endforeach;
  $var = substr($var, 0, strlen($var)-2).']';
  return $var;


}

public function returnCol_model($user,$indicator){

    $criterio_busqueda = new Criteria();
    $criterio_busqueda->add(TreeScPeer::ID,$indicator[1]);
    $tree = TreeScPeer::doSelectOne($criterio_busqueda);

    $criterio_busqueda->clear();
    $criterio_busqueda->add(DataIndicadoresPeer::USER_ID,$user->getId());
//    $criterio_busqueda->add(DataIndicadoresPeer::PERIODO_ID,$tree->getPeriodoId());
    $criterio_busqueda->add(DataIndicadoresPeer::INDICADOR_ID,$indicator[0]);
    $list =DataIndicadoresPeer::doSelect($criterio_busqueda);

     $var = "[";
     $var = $var."{name:'name',index:'name', width:180, sorttype:'text',editable: false},{";
     $cantidad = 1;
            foreach($list as $data):                  
                    $var=$var."name:'f".$cantidad."',index:'f".$cantidad."',width:100,editable: true , editrules:{required:true,number:true} },";
                    $var=$var."{name:'idfecha".$cantidad."',index:'idfecha".$cantidad."',width:100,editable: true,hidden:true },{";
                    $cantidad ++;
            endforeach;
  $var = substr($var, 0, strlen($var)-2).']';
  return $var;

}

public function assessNode($indicador_id){
 
    //el orden de las validacion sera por criterio de validaciones o errores comunes

    $indicador = IndicatorsScPeer::retrieveByPK($indicador_id);
    if(is_object($indicador)){
        if($indicador->getResponsableId()!=""){
            if($indicador->getValorMinimo()!=""){
                if($indicador->getValorDeseado()!=""){
                    if($indicador->getUltimoNodo()!=""){
                         //es ultimo nodo (validamos la ultima opcion de Valor Optimo)
                        if($indicador->getValorOptimo()!=""){
                            // validamos "lo demas"
                            if($indicador->getTitulo()!=""){
                                if($indicador->getDescripcion()!=""){
                                        //llegada A ==> INDICADOR OPTIMO
                                        return array('resp'=>true,'code' =>'1');
                                }else{
                                 // no tiene descripcion
                                return array('resp'=>false,'code' =>'e-006');                              
                                }
                            }else{
                                 // no tiene titulo
                                return array('resp'=>false,'code' =>'e-005');
                            }
                        }else{
                               // no tiene responsable Valor Optimo
                              return array('resp'=>false,'code' =>'e-004');
                        }
                    } else{                        
                       //no es ultimo nodo  (validamos los nodos hijos y despues "lo demas")
                       //obtener los nodos hijos:
                               //aca retorno lista de indicadores inferiores
                                //primero valido si tiene conectores inferiores                                

                                //si tiene concetores inferiores envio la lista de conectores inferiores
                                //en la consuta solo necesito id-configuracion(valor asignado por padre)-titulo
                                $criterio_busqueda = new Criteria();                                              
                                $criterio_busqueda->add(IndicatorsScPeer::PREVIOUS_ID,$indicador->getId());
                                $criterio_busqueda->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
                                $lista_indicadores_hijos = IndicatorsScPeer::doSelect($criterio_busqueda);

                               //ahora valido que todos tengan su porcentaje.
                                foreach($lista_indicadores_hijos as $row){                                   
                                    if($row->getConectoresConfigure()==""){
                                          return array('resp'=>false,'code' =>$row->getId());
                                    }
                                }
                                // si todos tienen un valor entonces valido lo mismo de arriba ..."lo demas" 
                                if($indicador->getTitulo()!=""){
                                    if($indicador->getDescripcion()!=""){
                                            //llegada A ==> INDICADOR OPTIMO
                                             return array('resp'=>true,'code' =>'1');
                                    }else{
                                     // no tiene descripcion
                                     return array('resp'=>false,'code' =>'e-006');
                                    }
                                }else{
                                     // no tiene titulo
                                     return array('resp'=>false,'code' =>'e-005');
                                }
                    }
                }else{
                 // no tiene responsable Valor Deseado
                 return array('resp'=>false,'code' =>'e-003');
                }
            }else{
            // no tiene responsable Valor Minimo
             return array('resp'=>false,'code' =>'e-002');
            }
        }else{
            // no tiene responsable ID
             return array('resp'=>false,'code' =>'e-001');
        }

    }else{
         return array('resp'=>false,'code' =>'e-666');
    }
}


public function current_color_production($indicator_id,$array_color){
    $indicator = IndicatorsScPeer::retrieveByPK($indicator_id);
    $valor_minimo  = $indicator->getValorMinimo();
    $valor_desaado = $indicator->getValorDeseado();
    $valor_optimo  = $indicator->getValorOptimo();
    $valor_actual  = $indicator->getValorActualEntregado();


    if($valor_actual>=$valor_desaado){
         return $array_color[0];
    }elseif($valor_actual>=$valor_minimo){
        return $array_color[1];
    }else{
        return $array_color[2];
    }
}

}
?>
