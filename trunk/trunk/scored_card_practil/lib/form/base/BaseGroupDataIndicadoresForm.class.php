<?php

/**
 * GroupDataIndicadores form base class.
 *
 * @method GroupDataIndicadores getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseGroupDataIndicadoresForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'create_at'  => new sfWidgetFormDateTime(),
      'periodo_id' => new sfWidgetFormPropelChoice(array('model' => 'PeriodoSc', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'create_at'  => new sfValidatorDateTime(array('required' => false)),
      'periodo_id' => new sfValidatorPropelChoice(array('model' => 'PeriodoSc', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group_data_indicadores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupDataIndicadores';
  }


}
