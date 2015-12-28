<?php

/**
 * GrupoTrabajoSc form base class.
 *
 * @method GrupoTrabajoSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseGrupoTrabajoScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInputText(),
      'owner_id'  => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => false)),
      'flag'      => new sfWidgetFormTextarea(),
      'create_at' => new sfWidgetFormDateTime(),
      'update_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 250)),
      'owner_id'  => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id')),
      'flag'      => new sfValidatorString(array('required' => false)),
      'create_at' => new sfValidatorDateTime(array('required' => false)),
      'update_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('grupo_trabajo_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GrupoTrabajoSc';
  }


}
