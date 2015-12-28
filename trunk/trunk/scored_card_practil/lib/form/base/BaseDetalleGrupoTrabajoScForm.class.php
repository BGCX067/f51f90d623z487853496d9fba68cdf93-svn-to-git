<?php

/**
 * DetalleGrupoTrabajoSc form base class.
 *
 * @method DetalleGrupoTrabajoSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDetalleGrupoTrabajoScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'email'    => new sfWidgetFormInputText(),
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'grupo_id' => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'email'    => new sfValidatorString(array('max_length' => 50)),
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id', 'required' => false)),
      'grupo_id' => new sfValidatorPropelChoice(array('model' => 'GrupoTrabajoSc', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('detalle_grupo_trabajo_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleGrupoTrabajoSc';
  }


}
