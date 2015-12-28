<?php

/**
 * TmpDataReports filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTmpDataReportsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'indicador_id'                => new sfWidgetFormFilterInput(),
      'valor_minimo'                => new sfWidgetFormFilterInput(),
      'valor_deseado'               => new sfWidgetFormFilterInput(),
      'valor_optimo'                => new sfWidgetFormFilterInput(),
      'tree_id'                     => new sfWidgetFormPropelChoice(array('model' => 'TmpTreeSc', 'add_empty' => true)),
      'previous_id'                 => new sfWidgetFormFilterInput(),
      'parents'                     => new sfWidgetFormFilterInput(),
      'indicadores_hijos_configure' => new sfWidgetFormFilterInput(),
      'ultimo_nodo'                 => new sfWidgetFormFilterInput(),
      'data'                        => new sfWidgetFormFilterInput(),
      'conectores_configure'        => new sfWidgetFormFilterInput(),
      'update_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'flag'                        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'indicador_id'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_minimo'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_deseado'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_optimo'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tree_id'                     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TmpTreeSc', 'column' => 'id')),
      'previous_id'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parents'                     => new sfValidatorPass(array('required' => false)),
      'indicadores_hijos_configure' => new sfValidatorPass(array('required' => false)),
      'ultimo_nodo'                 => new sfValidatorPass(array('required' => false)),
      'data'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'conectores_configure'        => new sfValidatorPass(array('required' => false)),
      'update_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'flag'                        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tmp_data_reports_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TmpDataReports';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'indicador_id'                => 'Number',
      'valor_minimo'                => 'Number',
      'valor_deseado'               => 'Number',
      'valor_optimo'                => 'Number',
      'tree_id'                     => 'ForeignKey',
      'previous_id'                 => 'Number',
      'parents'                     => 'Text',
      'indicadores_hijos_configure' => 'Text',
      'ultimo_nodo'                 => 'Text',
      'data'                        => 'Number',
      'conectores_configure'        => 'Text',
      'update_at'                   => 'Date',
      'flag'                        => 'Text',
    );
  }
}
