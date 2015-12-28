<?php

/**
 * TreeUser form base class.
 *
 * @method TreeUser getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTreeUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => false)),
      'tree_id' => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id')),
      'tree_id' => new sfValidatorPropelChoice(array('model' => 'TreeSc', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tree_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TreeUser';
  }


}
