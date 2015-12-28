<?php

class configurationActions extends sfActions {

    public function executeIndex(sfWebRequest $request){
        $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'));
        $google_configuration = null;

        $c = new Criteria();
        $c->add(UserGoogleConfigurationPeer::USER_ID, $current_user->getId());
        $google_configuration = UserGoogleConfigurationPeer::doSelectOne($c);
        $this->google_configuration = $google_configuration;
    }

    public function executeSave(sfWebRequest $request){
        $client_id = $request->getParameter('client_id');
        $client_secret = $request->getParameter('client_secret');
        $current_user = $this->getUser()->getAttribute(sfConfig::get('app_session_current_user'));

        $c = new Criteria();
        $c->add(UserGoogleConfigurationPeer::USER_ID, $current_user->getId());
        $google_configuration = UserGoogleConfigurationPeer::doSelectOne($c);
        
        if(is_object($google_configuration)){//existe: set
            $object = $google_configuration;
        }else{//no existe: new
            $object = new UserGoogleConfiguration();
        }
            $object->setGoogleClientId($client_id);
            $object->setGoogleClientSecret($client_secret);
            $object->setUserId($current_user->getId());
            $object->save();

        $this->redirect('@configuration');
    }

}