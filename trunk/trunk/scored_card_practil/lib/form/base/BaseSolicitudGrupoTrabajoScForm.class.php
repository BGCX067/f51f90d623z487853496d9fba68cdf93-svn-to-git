<?php

/**
 * SolicitudGrupoTrabajoSc form base class.
 *
 * @method SolicitudGrupoTrabajoSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSolicitudGrupoTrabajoScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'grupo_id'   => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'email'      => new sfWidgetFormInputText(),
      'create_at'  => new sfWidgetFormDateTime(),
      'update_at'  => new sfWidgetFormDateTime(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'token'      => new sfWidgetFormTextarea(),
      'flag'       => new sfWidgetFormTextarea(),
      'respondido' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'grupo_id'   => new sfValidatorPropelChoice(array('model' => 'GrupoTrabajoSc', 'column' => 'id', 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 50)),
      'create_at'  => new sfValidatorDateTime(array('required' => false)),
      'update_at'  => new sfValidatorDateTime(array('required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id', 'required' => false)),
      'token'      => new sfValidatorString(array('required' => false)),
      'flag'       => new sfValidatorString(array('required' => false)),
      'respondido' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('solicitud_grupo_trabajo_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SolicitudGrupoTrabajoSc';
  }


}
