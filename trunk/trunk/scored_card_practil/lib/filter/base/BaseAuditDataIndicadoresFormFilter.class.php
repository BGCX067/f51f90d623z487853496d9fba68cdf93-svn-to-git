<?php

/**
 * AuditDataIndicadores filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseAuditDataIndicadoresFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'DataIndicadores', 'add_empty' => true)),
      'data'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'create_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'indicador_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'DataIndicadores', 'column' => 'id')),
      'data'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'create_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('audit_data_indicadores_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AuditDataIndicadores';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'indicador_id' => 'ForeignKey',
      'data'         => 'Number',
      'create_at'    => 'Date',
    );
  }
}
