<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectionsImplementation
 *
 * @author USUARIO
 *
 * -VM = Valor Minimo
 * -VD = Valor Deseado
 * -VO = Valor Optimo
 */
class ProjectionsImplementation  extends ProjectionsValidator implements ProjectionsInterface  {

     /* == Se encargara de generar toda la data de las proyecciones ==
     * 1 recibira el id del arbol,
     * 2 verificar si existe
     * 3 verificar si tienen nodos activos
     * 4 se generara un array de fechas proyectadas
     *   (12 en total-el inicio se tomara de acuerdo al periodo con el cual se creo el arbol)
     * 5 se crea la proyeccion por cada indicador, se le pasan paramatros en un array
     *   (el objecto indicador,y la fecha proyectada)
     * 6 finaliza el metodo enviando una respuesta SUCCESS = TRUE + un mensaje de finalizacion
     */    
    public function generateData($treeId)
    {
        $validatorTree = new TreeValidator();
        $successTree   = $validatorTree->TreeExists($treeId, "id");
        /* 2 */
        if($successTree['success'])
        {
              $treeBean             = $successTree['object'];
              $successIndicadores   = $validatorTree->haveChildren($treeBean);
               /* 3 */
               if($successIndicadores['success'])
               {
                    /* 4 */
                    $arrayFechas = $this->generateArrayProyeccionesFechas($treeBean->getPeriodoId());
                    /* 5 */
                    $dataArray       = array(
                                         "success"=>true,
                                         "arrayFechas" =>$arrayFechas,
                                         "arrayIndicadores" =>$successIndicadores['object']
                                        );
                     $success = $this->generateDataIndicador($dataArray);
                     if($success['success'])
                     {
                        return array( "success" => true ,"message" => "registros creados exitosamente!");
                     }
               }
               else
               {
                    return  array("success"=>false,"message" =>"{generateData}-el arbol no tienen ningun indicador");
               }
        }
        else
        {
            return  array("success"=>false,"message" =>"{generateData}-tree no encontrado");
        }
        
    }


    /*
     * Genera las proyecciones , 12 registros por cada indicador
     */
    private function generateDataIndicador($dataArray)
    {
        $lisIndicadores = $dataArray['arrayIndicadores'];
        $lisFechas      = $dataArray['arrayFechas'];

        foreach($lisIndicadores as $indicador)
        {
            for($i=0;$i<12;$i++)
            {
                $proyection = new ProjectionsIndicatorsCs();
                $proyection->setIndicadorId($indicador->getId());
                $proyection->setFecha($lisFechas[$i]);
                $proyection->setValorMinimo($indicador->getValorMinimo());
                $proyection->setValorDeseado($indicador->getValorDeseado());
                $proyection->setValorOptimo($indicador->getValorOptimo());
                $proyection->setFlag('{}');
                $proyection->save();
            }
        }
        return array( "success" => true );
    }

    public function generateDataIndicadorOnline($treeId,$indicadorParametro)
    {
        $criteria = new Criteria();
        $criteria->add(IndicatorsScPeer::TREE_ID,$treeId);
        $criteria->add(IndicatorsScPeer::FLAG,'%habilitado%',Criteria::LIKE);
        /*obtengo el cualquier nodo habilitado de la estrategia
         * para obtener la cantidad de proyecciones que tenia y asi asignarles la
         * misma cantidad de proyecciones para el nuevo indicador.
         */
        $indicador = IndicatorsScPeer::doSelectOne($criteria);
        if(is_object($indicador))
        {
            $criteria->clear();
            $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$indicador->getId());
            $countProjection = ProjectionsIndicatorsCsPeer::doCount($criteria);
            $listProjection = ProjectionsIndicatorsCsPeer::doSelect($criteria);
            if($countProjection>0)
            {
                /*Asigno la misma cantidad de proyecciones al nuevo indicador*/
                foreach($listProjection as $row)
                {
                    $proyection = new ProjectionsIndicatorsCs();
                    $proyection->setIndicadorId($indicadorParametro->getId());
                    $proyection->setFecha($row->getFecha());
                    $proyection->setValorMinimo($indicadorParametro->getValorMinimo());
                    $proyection->setValorDeseado($indicadorParametro->getValorDeseado());
                    $proyection->setValorOptimo($indicadorParametro->getValorOptimo());
                    $proyection->setFlag('{}');
                    $proyection->save();
                }
                return array("success"=>true,"message" => "exito");
            }
            else
            {
               return array("success"=>false,"message" => "count 0 list");
            }
        }
        else
        {
           return array("success"=>false,"message" => "not object found");
        }
    }  
   /*
    * Genera las fechas 12 fechas proyectadas
    */
    private function generateArrayProyeccionesFechas($frecuencia)
    {
         $array      = array();
         $fechaInic  = $this->generateFechaInicial($frecuencia);

         $array[] =  date("Y-m-d", mktime(0, 0, 0,date("m"),date("d"),date("Y")) );
         $array[] =  $fechaInic;
         for($i=0;$i<10;$i++)
         {
                $dia  =  date("d",strtotime($fechaInic));
                $mes  =  date("m",strtotime($fechaInic));
                $anio =  date("Y",strtotime($fechaInic));
                if($frecuencia==1)
                {/* semanalmente (Todos los lunes) */                
                $fechaInic   =  date("Y-m-d", mktime( 0, 0, 0,$mes,$dia+7,$anio ) );
                }
                elseif($frecuencia==2)
                {/* quincenalmente (Todas las quincenas) */
                $fechaInic   =  date("Y-m-d", mktime( 0, 0, 0,$mes+1,15,$anio ) );
                }
                else
                {/* mensualmente (Todas los 1) */
                $fechaInic   =  date("Y-m-d", mktime( 0, 0, 0,$mes+1,1,$anio ) );
                }
                $array[]   = $fechaInic;   
        }

        return $array;
    }

  /*
   * Obtiene la fecha inicial para que el metodo "generateArrayProyeccionesFechas"
   * tenga una fecha inicio
   */
   private function generateFechaInicial($frecuencia)
   {
            $fechaInic= "";
            if($frecuencia==1)
            {
            $fechaInic=date("Y-m-d", strtotime ("next Monday"));
            }
            elseif($frecuencia==2)
            {/* quincenalmente (Todas las quincenas) */

                if(date("d")<15)
                {
                    $fechaInic = date("Y-m-d", mktime(0, 0, 0,date("m"),15,date("Y")) );
                }
                else
                {
                    $fechaInic = date("Y-m-d", mktime(0, 0, 0,date("m")+1,15,date("Y")) );
                }
            }
            else
            {/* mensualmente (Todas los 1) */
                    $fechaInic = date("Y-m-d", mktime(0, 0, 0,date("m")+1,1,date("Y")) );
            }
            return $fechaInic;
    }


    /*
     * Obetener la ultima fecha de proyeccion y en base a eso sacar la nueva fecha
     * 
     */
    public function generateProjectionCronJob($treeId)
    {
        $validatorTree = new TreeValidator();
        $successTree   = $validatorTree->TreeExists($treeId, "id");
       
        if($successTree['success'])
        {
              $treeBean             = $successTree['object'];
              $successIndicadores   = $validatorTree->haveChildren($treeBean);
               
              if($successIndicadores['success'])
              {
                    $arrayFechas = $this->generateArrayProyeccionesFechas($treeBean->getPeriodoId());
              }
              else
              {
                   return  array("success"=>false,"message" =>"{generateProjectionCronJob}-el arbol no tienen ningun indicador");
              }
        }
        else
        {
            return  array("success"=>false,"message" =>"{generateProjectionCronJob}-tree no encontrado");
        }
    }

    public function returnValueProjection($idicatorId,$fecha)
    {
        $criteria = new Criteria();
        $criteria->add(ProjectionsIndicatorsCsPeer::INDICADOR_ID,$idicatorId);
        $criteria->add(ProjectionsIndicatorsCsPeer::FECHA,$fecha);
        $projection = ProjectionsIndicatorsCsPeer::doSelectOne($criteria);
        if(is_object($projection))
        {
            return array ("success"=>true,"vo"=>$projection->getValorOptimo(),"vd"=>$projection->getValorDeseado(),"vm"=>$projection->getValorMinimo());
        }
        else
        {
            return array ("success"=>false,"message"=>$idicatorId."-error-".$fecha);
        }

    }



}
?>
