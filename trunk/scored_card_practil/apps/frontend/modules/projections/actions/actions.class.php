<?php

/**
 * projections actions.
 *
 * @package    practil_scorecard
 * @subpackage projections
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class projectionsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeList(sfWebRequest $request)
  {

    $user  = $this->getUser()->getAttribute('s_current_user',null);
    if($user!=null)
    {
        $criterio = new Criteria();
        $criterio->add(TreeScPeer::USER_ID,$user->getId());
        $criterio->add(TreeScPeer::FLAG,1);
        $list_tree = TreeScPeer::doSelect($criterio);
        $this->list = $list_tree;
        return sfView::SUCCESS;
    }
    else
    {
        return sfView::ERROR;
    }

  }

  public function executeIndex(sfWebRequest $request)
  {
        $user                 = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'),null);
        $treeId               = $request->getParameter('idTree');

        $serviceValidatorTree = new TreeValidator();
        $successTree          = $serviceValidatorTree->TreeExists($treeId, 'id');
        
        if($user!=null)
        {
           if($successTree['success'])
            {
                $treeBean = $successTree['object'];
                if($treeBean->getUserId()==$user->getId())
                {
                    $successChildren = $serviceValidatorTree->haveChildren($treeBean);
                    if($successChildren['success'])
                    {
                        $this->listaIndicadores = $successChildren['object'];
                        $this->treeBean         = $treeBean;
                    }
                    else
                    {
                        $this->message="error tree not children";
                        return sfView::ERROR;
                    }
                }
                else
                {
                    $this->message="error owner tree";
                    return sfView::ERROR;
                }
            }
            else
            {
                 $this->message="error tree not found";
                return sfView::ERROR;
            }
        }
        else
        {
            $this->redirect('@homepage');
        }

  }

  public function executeSaveProjections(sfWebRequest $request)
  {
 

    for($i =1; $i<13;$i++)
    {
        $id_proyeccion = $request->getParameter('idfecha'.$i);
        $data_proyeccion = $request->getParameter('f'.$i);
        if($id_proyeccion!="")
        {
            $proyeccion = ProjectionsIndicatorsCsPeer::retrieveByPK($id_proyeccion);
            if(is_object($proyeccion))
            {
                $value = explode("-", $request->getParameter('id'));
                if($value[0]=="valor_min")
                {
                   $proyeccion->setValorMinimo($data_proyeccion);
                }
                elseif($value[0]=="valor_des")
                {
                   $proyeccion->setValorDeseado($data_proyeccion);
                }
                else
                {
                   $proyeccion->setValorOptimo($data_proyeccion);
                }
                   $proyeccion->save();
            }
            
        }
   }    



  }

}
