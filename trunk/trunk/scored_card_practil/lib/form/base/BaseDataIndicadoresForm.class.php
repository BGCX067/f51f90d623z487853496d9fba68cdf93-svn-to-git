<?php

/**
 * DataIndicadores form base class.
 *
 * @method DataIndicadores getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDataIndicadoresForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'IndicatorsSc', 'add_empty' => false)),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => false)),
      'data'         => new sfWidgetFormInputText(),
      'group_data'   => new sfWidgetFormPropelChoice(array('model' => 'GroupDataIndicadores', 'add_empty' => false)),
      'create_at'    => new sfWidgetFormDateTime(),
      'update_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'indicador_id' => new sfValidatorPropelChoice(array('model' => 'IndicatorsSc', 'column' => 'id')),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id')),
      'data'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'group_data'   => new sfValidatorPropelChoice(array('model' => 'GroupDataIndicadores', 'column' => 'id')),
      'create_at'    => new sfValidatorDateTime(array('required' => false)),
      'update_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('data_indicadores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataIndicadores';
  }


}
