<?php

/**
 * UserSc form base class.
 *
 * @method UserSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseUserScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'email'         => new sfWidgetFormInputText(),
      'profile'       => new sfWidgetFormInputText(),
      'password'      => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'flag'          => new sfWidgetFormTextarea(),
      'token_session' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'email'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'profile'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'password'      => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'flag'          => new sfValidatorString(array('required' => false)),
      'token_session' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserSc';
  }


}
