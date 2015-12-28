<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectionsTable
 *
 * @author USUARIO
 */
class ProjectionsGrid {


 /* == Retorna el nombre de las columnas (las 12 ultimas fechas proyectadas)==
  * 1 recibo como parametro el objecto indicador
  * 2 verifico que indicador sea un objeto
  * 3 busco las dos ultimas fechas proyectadas en la tabla de proyecciones
  * 4 comienzo a generar las columnas ( Cabezeras )
  */

 public function returnCol_names($indicatorBean)
 {
        $var = null;
        if(is_object($indicatorBean))
        {
             $listaProyecciones = $this->sqlSelectList($indicatorBean);

            $var = "['Indicador','";
            $cantidad = 1;
            foreach($listaProyecciones as $proyeccion):
                        $fecha = new DateTime($proyeccion->getFecha());
                        $var=$var.$fecha->format('d-m-Y')."','idfecha".$cantidad."','";
                        $cantidad ++;
             endforeach;
             $var = substr($var, 0, strlen($var)-2).']';
        }

        return $var;
      
   }


   /* == Retorna el modelo del grid (las 12 ultimas fechas proyectadas)==
      * 1 recibo como parametro el objecto indicador
      * 2 verifico que indicador sea un objeto
      * 3 busco las dos ultimas fechas proyectadas en la tabla de proyecciones
      * 4 comienzo a generar las columnas ( Cabezeras )
  */
   public function returnCol_model($indicatorBean)
   {
        $var = null;
        if(is_object($indicatorBean))
        {
            $listaProyecciones = $this->sqlSelectList($indicatorBean);

            $editable = 'false';
            $var = "[";
            $var = $var."{name:'name',index:'name', width:130, sorttype:'text',editable: false},{";
            $cantidad = 1;
                   foreach($listaProyecciones as $proyeccion):
                           $var=$var."name:'f".$cantidad."',index:'f".$cantidad."',width:90,editable: true , editrules:{required:true,number:true} },";
                           $var=$var."{name:'idfecha".$cantidad."',index:'idfecha".$cantidad."',width:95,editable: true,hidden:true },{";
                           $cantidad ++;
                   endforeach;
             $var = substr($var, 0, strlen($var)-2).']';
        }
       return $var;
  }



 public function returnData_indicadores($indicatorBean)
 {

        $var = null;
        if(is_object($indicatorBean))
        {
           
            $listaProyecciones = $this->sqlSelectList($indicatorBean);
        }

    $var = '[';
    for($i=0;$i<3;$i++)
    {
        /**************************************************************/
        if($i==0)
        {
         $cantidad = 1;
         $var=$var.'{name:"Valor Minimo",';
         foreach($listaProyecciones as $proyeccion):
                if($cantidad==count($listaProyecciones))
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorMinimo().'",';
                    $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'"},';
                    $cantidad ++;
                }
                else
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorMinimo().'",';
                    $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'",';
                    $cantidad ++;
                }                              
         endforeach;
        }
        /**************************************************************/
        if($i==1)
        {
         $cantidad = 1;
         $var=$var.'{name:"Valor Deseado",';
         foreach($listaProyecciones as $proyeccion):
                if($cantidad==count($listaProyecciones))
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorDeseado().'",';
                     $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'"},';
                    $cantidad ++;
                }
                else
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorDeseado().'",';
                    $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'",';
                    $cantidad ++;
                }
         endforeach;
        }
        /**************************************************************/
        if($i==2)
        {
         $cantidad = 1;
         $var=$var.'{name:"Valor Optimo",';
         foreach($listaProyecciones as $proyeccion):
                if($cantidad==count($listaProyecciones))
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorOptimo().'",';
                    $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'"}';
                    $cantidad ++;
                }
                else
                {
                    $var=$var.'f'.$cantidad.':"'.$proyeccion->getValorOptimo().'",';
                    $var=$var.'idfecha'.$cantidad.':"'.$proyeccion->getId().'",';
                    $cantidad ++;
                }
         endforeach;
        }


    }

    $var = $var.']';
    return $var;

}

private function sqlSelectList($indicatorBean)
{

    $criteria = new Criteria();
    $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$indicatorBean->getId());
    $criteria->addAscendingOrderByColumn(ProjectionsIndicatorsCsPeer::FECHA);
    $cantidad = ProjectionsIndicatorsCsPeer::doCount($criteria);
    $criteria->setOffset($cantidad-12);
    $criteria->setLimit(12);
    $listaProyecciones = ProjectionsIndicatorsCsPeer::doSelect($criteria);
    return $listaProyecciones;

}


}
?>
