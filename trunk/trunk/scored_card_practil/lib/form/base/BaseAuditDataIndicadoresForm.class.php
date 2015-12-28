<?php

/**
 * AuditDataIndicadores form base class.
 *
 * @method AuditDataIndicadores getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAuditDataIndicadoresForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'DataIndicadores', 'add_empty' => false)),
      'data'         => new sfWidgetFormInputText(),
      'create_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'indicador_id' => new sfValidatorPropelChoice(array('model' => 'DataIndicadores', 'column' => 'id')),
      'data'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'create_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('audit_data_indicadores[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AuditDataIndicadores';
  }


}
