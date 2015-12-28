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


    if($list[0]->getIndicatorsSc()->getDetNetworkAttributeId()==null){
               $info = 'manual';
     }else{
               $info = 'automatico';
    }


    $var = '{name:"'.$list[0]->getIndicatorsSc()->getTitulo().'",info:"'.$list[0]->getIndicatorsSc()->getDescripcion().'", tipo:"'.$info.'",';
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

     $var = "['Descripcion','Info','Informacion','";
     $cantidad = 1;
        foreach($list as $data):
            $fecha = new DateTime($data->getCreateAt());
            $var=$var.$fecha->format('d-m-Y')."','idfecha".$cantidad."','";
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
//  $criterio_busqueda->add(DataIndicadoresPeer::PERIODO_ID,$tree->getPeriodoId());
    $criterio_busqueda->add(DataIndicadoresPeer::INDICADOR_ID,$indicator[0]);
    $list =DataIndicadoresPeer::doSelect($criterio_busqueda);

     $editable = 'false';
     $var = "[";
     $var = $var."{name:'name',index:'name', width:250, sorttype:'text',editable: false},{name:'info',index:'info', width:25, sorttype:'text',editable: false},{name:'tipo',index:'tipo', width:88, sorttype:'text',editable: false},{";
     $cantidad = 1;
            foreach($list as $data): 
                    $var=$var."name:'f".$cantidad."',index:'f".$cantidad."',width:85,editable: true , editrules:{required:true,number:true} },";
                    $var=$var."{name:'idfecha".$cantidad."',index:'idfecha".$cantidad."',width:95,editable: true,hidden:true },{";
                    $cantidad ++;
            endforeach;
  $var = substr($var, 0, strlen($var)-2).']';
  return $var;

}

public function assessNode($indicador_id)
{
 
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
                                        //llegada A ==> INDICADOR OPTIMO
                                        return array('resp'=>true,'code' =>'1');
                                
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
                                            //llegada B ==> INDICADOR OPTIMO
                                             return array('resp'=>true,'code' =>'1');
                                    
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


public function obtenerValoresDeProyecciones($indicador,$fecha,$id=null)
{
    $dia  =  date("d",strtotime($fecha));
    $mes  =  date("m",strtotime($fecha));
    $anio =  date("Y",strtotime($fecha));
    $fecha   =  date("Y-m-d", mktime( 0, 0, 0,$mes,$dia,$anio ) );
    $criteria = new Criteria();
    
    if($id!=null)
    {/*si recibo el id directamente busca con ese parametro*/
        $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$id);
    }
    else
    {/*si recibe el objeto, obtiene la informacion a parir del objeto*/
        $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$indicador->getId());
    }
   

    $criteria->add(ProjectionsIndicatorsCsPeer::FECHA,$fecha);
    $proyeccion = ProjectionsIndicatorsCsPeer::doSelectOne($criteria);

    if(is_object($proyeccion))
    {

        return array("success"=>true,"message"=>"exito","object" =>$proyeccion);
    }
    else
    {
        return array("success"=>false,"message"=>"proyeccion no encotrada");
    }
}


public function current_color_production($indicator_id,$array_color,$proyeccionBean=null){


    $indicator = IndicatorsScPeer::retrieveByPK($indicator_id);

    $valor_minimo  = $proyeccionBean['object']->getValorMinimo();
    $valor_desaado = $proyeccionBean['object']->getValorDeseado();
    $valor_optimo  = $proyeccionBean['object']->getValorOptimo();
    $valor_actual  = $indicator->getValorActualEntregado();


    //vmini   = 10
    //vdesead = 20
    //voption = 30

    ///////    15   array('#70FF8A','#FF8787','#FF0000')                                    
  
    if($valor_actual>$valor_desaado)
    {
         return $array_color[0];
    
    }

    elseif($valor_actual>$valor_minimo)
    {
        return $array_color[1];
    }else{
        return $array_color[2];
    }
}

    public function getTipoConector($nodo_id){
        $indicador = IndicatorsScPeer::retrieveByPK($nodo_id);
        if($indicador->getDetNetworkAttributeId()!=null){
            $resp = $indicador->getDetNetworkAttribute()->getNetwork()->getName();
        }else{
            $resp = "Manual";
        }
        return $resp;
    }

    public function getDataUser($profile){
      $ids = array();
     $ids[] = $profile;

     $lib = new practil_lib();
     $url = $lib->url_practil_get_users($ids);

     $array_users = array();
     $respuesta_get_users = @file_get_contents($url);
     if($respuesta_get_users === FALSE){
           // echo 'Not connected to Practil';
            return sfView::null;
     }else{
            $json_get_users = json_decode($respuesta_get_users);
            if($json_get_users->{'success'}==false){
                //echo $json_get_users->{'message'};
                return sfView::null;
            }else{
                $array_users = $json_get_users->{'practil'}->{'accounts'};
                if(count($array_users)<=0){
                   // echo 'Users Array returned 0 elements';
                    return sfView::null;
                }
            }
             return $array_users;
        }
    }

    public function optionBasicUser(){
       return $array =  array(
            "helpCreateStrategy" => true,
            "other" => true
        );
        
    }

   public function returnSucessHelp($json)
   {

   
      $option            =  json_decode($json);
      $succesLayoutHelp  = $option->{'helpStrategy1'};
  
     
      return $succesLayoutHelp;
   }


}
?>
