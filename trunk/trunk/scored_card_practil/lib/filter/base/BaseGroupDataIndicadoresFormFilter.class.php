<?php

/**
 * GroupDataIndicadores filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseGroupDataIndicadoresFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'create_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'periodo_id' => new sfWidgetFormPropelChoice(array('model' => 'PeriodoSc', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'create_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'periodo_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PeriodoSc', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('group_data_indicadores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupDataIndicadores';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'create_at'  => 'Date',
      'periodo_id' => 'ForeignKey',
    );
  }
}
