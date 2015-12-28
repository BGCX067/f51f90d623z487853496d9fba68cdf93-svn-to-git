<?php

/**
 * TreeSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTreeScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(),
      'descripcion'       => new sfWidgetFormFilterInput(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'grupo_trabajo_id'  => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'periodo_id'        => new sfWidgetFormPropelChoice(array('model' => 'PeriodoSc', 'add_empty' => true)),
      'responsable_id'    => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'email_responsable' => new sfWidgetFormFilterInput(),
      'valor_minimo'      => new sfWidgetFormFilterInput(),
      'valor_deseado'     => new sfWidgetFormFilterInput(),
      'configure_flag'    => new sfWidgetFormFilterInput(),
      'flag'              => new sfWidgetFormFilterInput(),
      'create_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'update_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'configure_design'  => new sfWidgetFormFilterInput(),
      'produccion'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'descripcion'       => new sfValidatorPass(array('required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'grupo_trabajo_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GrupoTrabajoSc', 'column' => 'id')),
      'periodo_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PeriodoSc', 'column' => 'id')),
      'responsable_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'email_responsable' => new sfValidatorPass(array('required' => false)),
      'valor_minimo'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_deseado'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'configure_flag'    => new sfValidatorPass(array('required' => false)),
      'flag'              => new sfValidatorPass(array('required' => false)),
      'create_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'update_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'configure_design'  => new sfValidatorPass(array('required' => false)),
      'produccion'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tree_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TreeSc';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'descripcion'       => 'Text',
      'user_id'           => 'ForeignKey',
      'grupo_trabajo_id'  => 'ForeignKey',
      'periodo_id'        => 'ForeignKey',
      'responsable_id'    => 'ForeignKey',
      'email_responsable' => 'Text',
      'valor_minimo'      => 'Number',
      'valor_deseado'     => 'Number',
      'configure_flag'    => 'Text',
      'flag'              => 'Text',
      'create_at'         => 'Date',
      'update_at'         => 'Date',
      'configure_design'  => 'Text',
      'produccion'        => 'Text',
    );
  }
}
