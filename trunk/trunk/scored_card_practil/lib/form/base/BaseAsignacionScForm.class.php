<?php

/**
 * AsignacionSc form base class.
 *
 * @method AsignacionSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAsignacionScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'grupo_id'     => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'email'        => new sfWidgetFormInputText(),
      'tree_id'      => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => false)),
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'IndicatorsSc', 'add_empty' => false)),
      'flag'         => new sfWidgetFormTextarea(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'create_at'    => new sfWidgetFormDateTime(),
      'update_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'grupo_id'     => new sfValidatorPropelChoice(array('model' => 'GrupoTrabajoSc', 'column' => 'id', 'required' => false)),
      'email'        => new sfValidatorString(array('max_length' => 50)),
      'tree_id'      => new sfValidatorPropelChoice(array('model' => 'TreeSc', 'column' => 'id')),
      'indicador_id' => new sfValidatorPropelChoice(array('model' => 'IndicatorsSc', 'column' => 'id')),
      'flag'         => new sfValidatorString(array('required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id', 'required' => false)),
      'create_at'    => new sfValidatorDateTime(array('required' => false)),
      'update_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('asignacion_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignacionSc';
  }


}
