<?php

/**
 * human actions.
 *
 * @package    practil_scorecard
 * @subpackage human
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class humanActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
public function executeIndex(sfWebRequest $request){

     
      $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

      if($user!=null){

           $criterio_busqueda = new Criteria();
           $criterio_busqueda->add(GrupoTrabajoScPeer::OWNER_ID,$user->getId());
           $criterio_busqueda->add(GrupoTrabajoScPeer::FLAG,1);
           $listado = GrupoTrabajoScPeer::doSelect($criterio_busqueda);
           $this->list = $listado;
           return sfView::SUCCESS;
            
      }else{
          return sfView::ERROR;
      }

  }

  public function executeList_human_group(sfWebRequest $request){
      
      $groupId = $request->getParameter('groupId');
      $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
      
      if($user!=null){

            $grupoBean = GrupoTrabajoScPeer::retrieveByPK($groupId);
            if(is_object($grupoBean)){
                //tengo que asegurarme que el usario que esta solicitando ver las preguntas
                //es el dueño del grupo
                if($grupoBean->getOwnerId()==$user->getId()){
                        $criterio_busqueda = new Criteria();
                        $criterio_busqueda->add(QuestionHumanScPeer::GRUPO_ID , $groupId);
                        //estados:
                            //-1 activo-sin check
                            //-2 chekeado+activo
                            //-3 eliminado
                        $criterio_busqueda->add(QuestionHumanScPeer::FLAG ,3,Criteria::NOT_EQUAL);
                        $lista_pteguntas = QuestionHumanScPeer::doSelect($criterio_busqueda);
                        $criterio_busqueda->clear();
                        $criterio_busqueda->add(PeriodoScPeer::FLAG,'%activo%',Criteria::LIKE);
                        $list_periodo = PeriodoScPeer::doSelect($criterio_busqueda);
                        $this->lista_periodos = $list_periodo;
                        $this->list_question = $lista_pteguntas;
                        $this->group = $grupoBean;

                         return sfView::SUCCESS;

                }else{
                     $this->success  = array("success"=>false,"code" => 1 , "html" => '<h3>Ups not is Owner!</h3>'  );
                     return sfView::ERROR;
                }
            }else{
                $this->success  = array("success"=>false,"code" => 2 , "html" => '<h3>Ups group not found!</h3>'  );
                return sfView::ERROR;
            }
      }else{
          $this->success  = array("success"=>false,"code" => 3 , "html" => '<h3>Ups session expired!</h3>'  );
       return sfView::ERROR;
      }



  }


public function executeEdit_question_human_check(sfWebRequest $request){
     //estados:
          //-1 activo-sin check
          //-2 chekeado+activo
          //-3 eliminado

      $request->setRequestFormat('json');
      $question_value = $request->getParameter('value');
      $question_id = $request->getParameter('questionId');
      $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

        if($user!=null){
            $questionBean = QuestionHumanScPeer::retrieveByPK($question_id);
            if(is_object($questionBean)){
                  if($question_value=="true"){
                      $questionBean->setFlag(2);
                  }else{
                      $questionBean->setFlag(1);
                  }
                  $questionBean->save();
                  return sfView::SUCCESS;
            }else{
                $this->error = 'no es el object';
                return sfView::ERROR;
            }
      }else{
          $this->error = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeEdit_question_human(sfWebRequest $request){

      $request->setRequestFormat('json');
      $question_text = $request->getParameter('questionText');
      $question_id = $request->getParameter('questionId');
      $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

        if($user!=null){
            $questionBean = QuestionHumanScPeer::retrieveByPK($question_id);
            if(is_object($questionBean)){
                  $questionBean->setQuestion($question_text);
                  $questionBean->save();

                  $cantidad = strlen($questionBean->getQuestion());
                  if($cantidad>55){
                      $question= substr($questionBean->getQuestion(), 0, 52);
                      $question = $question.' ....';
                  }else{
                      $question = $questionBean->getQuestion();
                  }

                  $this->pregunta = $question;
                  $this->preguntaBean = $questionBean;
                  return sfView::SUCCESS;
            }else{
                $this->error = 'no es el object';
                return sfView::ERROR;
            }
      }else{
          $this->error = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeDelete_question_human_ajax(sfWebRequest $request){

     $request->setRequestFormat('json');
     $id_question = $request->getParameter('questionId');
     $user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

     if($user!=null){
         $questionBean = QuestionHumanScPeer::retrieveByPK($id_question);
         if(is_object($questionBean)){
                //Verificamos si el owner
             if($questionBean->getUserId()==$user->getId()){
                 $questionBean->setFlag(3);
                 $questionBean->save();
                   return sfView::SUCCESS;
             }else{
                 $this->message='not owner';
                 return sfView::ERROR;
             }
         }else{
             $this->message='not object';
             return sfView::ERROR;
         }
     }else{
         $this->message='session expired';
         return sfView::ERROR;
     }

}

public function executeAdd_new_question_human(sfWebRequest $request){


      $question_text = $request->getParameter('questionText');
      $group_id = $request->getParameter('groupId');
      $user    = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

      if($user!=null){
            $grupoBean = GrupoTrabajoScPeer::retrieveByPK($group_id);
            if(is_object($grupoBean)){
                //tengo que asegurarme que el usario que esta solicitando ver las preguntas
                //es el dueño del grupo
                if($grupoBean->getOwnerId()==$user->getId()){
                          $questionBean = new QuestionHumanSc();
                          $questionBean->setUserId($user->getId());
                          $questionBean->setGrupoId($grupoBean->getId());
                          $questionBean->setQuestion($question_text);
                          $questionBean->setFlag(2);
                          $questionBean->setCreateAt(time());
                          $questionBean->save();
                          $this->pregunta = $questionBean;
                          return sfView::SUCCESS;

                }else{
                    $this->error = 'not owner';
                    return sfView::ERROR;
                }
            }else{
                $this->error = 'no es el object';
                return sfView::ERROR;
            }

      }else{
          $this->error = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeEdit_configuration_human_check(sfWebRequest $request){


      $request->setRequestFormat('json');
      $ck_top_boss = $request->getParameter('ckTopBoss');
      $ck_auto     = $request->getParameter('ckAuto');
      $group_id    = $request->getParameter('groupId');
      $user        = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

        if($user!=null){
            $groupBean = GrupoTrabajoScPeer::retrieveByPK($group_id);
            if(is_object($groupBean)){
                  if($groupBean->getOwnerId()==$user->getId()){

                          if($ck_top_boss=="true"){
                                 $groupBean->setHumanHigher('on');
                          }else{
                                 $groupBean->setHumanHigher('off');
                          }

                          if($ck_auto=="true"){
                                 $groupBean->setHumanMe('on');
                          }else{
                                 $groupBean->setHumanMe('off');
                          }

                          $groupBean->save();
                        return sfView::SUCCESS;
                  }else{
                      $this->message = 'not owner';
                      return sfView::ERROR;
                  }


            }else{
                $this->message = 'no es el object';
                return sfView::ERROR;
            }
      }else{
          $this->message = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeHumanscorecard_edit_periodo(sfWebRequest $request){

      $request->setRequestFormat('json');
      $periodo_id  = $request->getParameter('periodoId');
      $grupo_id  = $request->getParameter('grupoId');
      $user        = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

        if($user!=null){
            $periodoBean = PeriodoScPeer::retrieveByPK($periodo_id);
            $groupBean   = GrupoTrabajoScPeer::retrieveByPK($grupo_id);

                  if(is_object($groupBean)){
                      if($groupBean->getOwnerId()==$user->getId()){

                              if($periodo_id!="none"){
                                  $groupBean->setHumanPeriodoId($periodoBean->getId());
                              }else{
                                 $groupBean->setHumanFlag(1);
                                 $groupBean->setHumanPeriodoId(null);
                              }

                              $groupBean->save();
                            return sfView::SUCCESS;
                      }else{
                          $this->message = 'not owner';
                          return sfView::ERROR;
                      }

                }else{
                    $this->message = 'not object group';
                    return sfView::ERROR;
                }


      }else{
          $this->message = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeHumanscorecard_state_human(sfWebRequest $request){

      $request->setRequestFormat('json');

      $grupo_id  = $request->getParameter('groupId');
      $value    = $request->getParameter('value');
      $user        = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);

        if($user!=null){
            $groupBean   = GrupoTrabajoScPeer::retrieveByPK($grupo_id);
                  if(is_object($groupBean)){
                      if($groupBean->getOwnerId()==$user->getId()){
                               if($value=="on")
                                    $groupBean->setHumanFlag(2);
                               else
                                    $groupBean->setHumanFlag(1);
                               $groupBean->save();
                            return sfView::SUCCESS;
                      }else{
                          $this->message = 'not owner';
                          return sfView::ERROR;
                      }

                }else{
                    $this->message = 'not object group';
                    return sfView::ERROR;
                }
      }else{
          $this->message = 'no es el user';
          return sfView::ERROR;
      }

}

public function executeCron_human(sfWebRequest $request){

    $group_humman_id = $request->getParameter('');
    $criterio = new Criteria();
    $criterio->add(GrupoTrabajoScPeer::FLAG,1);
    $criterio->add(GrupoTrabajoScPeer::HUMAN_FLAG,2);
    $list_group = GrupoTrabajoScPeer::doSelect($criterio);

    if(count($list_group)>0){
        foreach($list_group as $row){
            $this->executeHuman_execute($row);
        }

    }

}

public function executeSurveys(sfWebRequest $request){

    $user      = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    if($user!=null){
        $criterio = new Criteria();
        $criterio->add(HeadEvaluacionesPeer::USER_ID,$user->getId());
        $criterio->add(HeadEvaluacionesPeer::FLAG,1);
        $lista  = HeadEvaluacionesPeer::doSelect($criterio);
        $this->lista_head=$lista;
    }else{
        return sfView::ERROR;
    }
}

public function executeA_surveys_ajax(sfWebRequest $request){

    $user      = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
    $encuesta_id = $request->getParameter('surveysId');

    if($user!=null){
         $headBean = HeadEvaluacionesPeer::retrieveByPK($encuesta_id);
          if(is_object($headBean)){
                if($headBean->getFlag()==1){
                        $criterio = new Criteria();
                        $criterio->add(EvaluacionesUserPeer::HEAD_ID,$encuesta_id);
                        $lista  = EvaluacionesUserPeer::doSelect($criterio);
                        $this->lista_preguntas=$lista;
                        $this->pk = $encuesta_id;
                        return sfView::SUCCESS;
                }else{
                    return sfView::ERROR;
                }

          }else{
              return sfView::ERROR;
          }

    }else{
        return sfView::ERROR;
    }

}

public function executeSurveys_answers(sfWebRequest $request){

    $request->setRequestFormat('json');
    $list_answers       =  $request->getParameter('list');
    $encuesta_id      =  $request->getParameter('surveysId');

     $criterio = new Criteria();
     $criterio->add(EvaluacionesUserPeer::HEAD_ID,$encuesta_id);
     $lista  = EvaluacionesUserPeer::doSelect($criterio);

     $headBean = HeadEvaluacionesPeer::retrieveByPK($encuesta_id);
     if(is_object($headBean)){
      $contador = 0;
             foreach($lista as $row){
                 $row->setRespuesta($list_answers[$contador]);
                 $row->save();
                 $contador++;
             }
      $headBean->setFlag(2);
      $headBean->save();
      return sfView::SUCCESS;
     }else{
         return sfView::ERROR;
     }




}

private function executeHuman_execute($group_humman){

    $group_humman_id = $group_humman->getId();
    $criterio = new Criteria();
    $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$group_humman_id);
    $list_group = DetalleGrupoTrabajoScPeer::doSelect($criterio);

    $criterio->clear();
    $criterio->add(QuestionHumanScPeer::GRUPO_ID,$group_humman_id);
    $criterio->add(QuestionHumanScPeer::FLAG,2);
    $list_question = QuestionHumanScPeer::doSelect($criterio);


    if(count($list_group)>0){

       //primero vamos a generar las preguntas que estan por defecto
        foreach($list_group as $row){
                  if($row->getUserId()!=null){
                    $list_down = $this->executeLevel_down($row->getUserSc(),$row->getGrupoTrabajoSc());
                    if(count($list_down)>0){
                         foreach($list_down as $user){
                                if(count($list_question)>0){
                                            $headQuestion = new HeadEvaluaciones();
                                            $headQuestion->setCreateAt(time());
                                            $headQuestion->setUpdateAt(time());
                                            $headQuestion->setUserId($row->getUserId());
                                            $headQuestion->setFlag(1);
                                            $headQuestion->save();
                                      foreach($list_question as $question){
                                            $beanQuestion = new EvaluacionesUser();
                                            $beanQuestion->setQuestionId($question->getId());
                                            $beanQuestion->setTypeQuestion(2);
                                            $beanQuestion->setEvaluated($user->getUserId());
                                            $beanQuestion->setHeadId($headQuestion->getId());
                                            $beanQuestion->setFlag(1);
                                            $beanQuestion->setRespuesta(0);
                                            $beanQuestion->save();
                                      }
                                 }
                         }
                    }


                }
        }
        //ahora level superior!!
        //vamos verificar si tiene activado la opcion
        if($group_humman->getHumanHigher()=='on'){

              foreach($list_group as $row2){
                if($row->getUserId()!=null){
                    $boss_id = $this->executeLevel_top($row2->getUserSc(),$row2->getGrupoTrabajoSc());

                    if($boss_id!=null){
                                $user2 = UserScPeer::retrieveByPK($boss_id);
                                if(is_object($user2)){
                                        if(count($list_question)>0){
                                                $headQuestion = new HeadEvaluaciones();
                                                $headQuestion->setCreateAt(time());
                                                $headQuestion->setUpdateAt(time());
                                                $headQuestion->setUserId($row2->getUserId());
                                                $headQuestion->setFlag(1);
                                                $headQuestion->save();
                                          foreach($list_question as $question){
                                                $beanQuestion = new EvaluacionesUser();
                                                $beanQuestion->setQuestionId($question->getId());
                                                $beanQuestion->setTypeQuestion(3);
                                                $beanQuestion->setEvaluated($user2->getId());
                                                $beanQuestion->setHeadId($headQuestion->getId());
                                                $beanQuestion->setFlag(1);
                                                $beanQuestion->setRespuesta(0);
                                                $beanQuestion->save();
                                           }
                                       }
                                }
                    }
                }
        }

        }

        //por ultimo vamos a ver la auto evaluacion
        //eso para despues....



    }


}

private function executeLevel_top($user,$group){

    $criterio = new Criteria();
    $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$group->getId());
    $criterio->add(DetalleGrupoTrabajoScPeer::USER_ID,$user->getId());

    $detalleBean = DetalleGrupoTrabajoScPeer::doSelectOne($criterio);
    if(is_object($detalleBean)){
        if($detalleBean->getBostId()!=0){
            return $detalleBean->getBostId();
        }else{
            return null;
        }
    }else{
        return null;
    }
}


private function executeLevel_down($user,$group){

    $criterio = new Criteria();
    $criterio->add(DetalleGrupoTrabajoScPeer::GRUPO_ID,$group->getId());
    $criterio->add(DetalleGrupoTrabajoScPeer::BOST_ID,$user->getId());

    $detalle_list_bean = DetalleGrupoTrabajoScPeer::doSelect($criterio);
    if(count($detalle_list_bean)>0){
            return $detalle_list_bean;
    }else{
            return null;
    }
}

}
