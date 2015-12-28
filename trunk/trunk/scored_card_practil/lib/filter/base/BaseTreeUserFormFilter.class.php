<?php

/**
 * TreeUser filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTreeUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'tree_id' => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'tree_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TreeSc', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tree_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TreeUser';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'user_id' => 'ForeignKey',
      'tree_id' => 'ForeignKey',
    );
  }
}
