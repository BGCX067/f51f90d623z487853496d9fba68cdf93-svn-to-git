<?php

/**
 * UserSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseUserScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'email'         => new sfWidgetFormFilterInput(),
      'profile'       => new sfWidgetFormFilterInput(),
      'password'      => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'flag'          => new sfWidgetFormFilterInput(),
      'token_session' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'email'         => new sfValidatorPass(array('required' => false)),
      'profile'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'password'      => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'flag'          => new sfValidatorPass(array('required' => false)),
      'token_session' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserSc';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'email'         => 'Text',
      'profile'       => 'Number',
      'password'      => 'Text',
      'created_at'    => 'Date',
      'flag'          => 'Text',
      'token_session' => 'Text',
    );
  }
}
