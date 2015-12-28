<?php

/**
 * TmpTreeSc form base class.
 *
 * @method TmpTreeSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTmpTreeScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'valor_minimo'   => new sfWidgetFormInputText(),
      'valor_deseado'  => new sfWidgetFormInputText(),
      'configure_flag' => new sfWidgetFormTextarea(),
      'flag'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'valor_minimo'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_deseado'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'configure_flag' => new sfValidatorString(array('required' => false)),
      'flag'           => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tmp_tree_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TmpTreeSc';
  }


}
