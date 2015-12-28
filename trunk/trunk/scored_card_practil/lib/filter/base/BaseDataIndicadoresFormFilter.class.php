<?php

/**
 * DataIndicadores filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseDataIndicadoresFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'IndicatorsSc', 'add_empty' => true)),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'data'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'group_data'   => new sfWidgetFormPropelChoice(array('model' => 'GroupDataIndicadores', 'add_empty' => true)),
      'create_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'update_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'indicador_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'IndicatorsSc', 'column' => 'id')),
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'data'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'group_data'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GroupDataIndicadores', 'column' => 'id')),
      'create_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'update_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('data_indicadores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DataIndicadores';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'indicador_id' => 'ForeignKey',
      'user_id'      => 'ForeignKey',
      'data'         => 'Number',
      'group_data'   => 'ForeignKey',
      'create_at'    => 'Date',
      'update_at'    => 'Date',
    );
  }
}
