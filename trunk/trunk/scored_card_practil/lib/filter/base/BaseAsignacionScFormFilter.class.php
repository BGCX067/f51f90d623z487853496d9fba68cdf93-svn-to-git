<?php

/**
 * AsignacionSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseAsignacionScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'grupo_id'     => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'email'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tree_id'      => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => true)),
      'indicador_id' => new sfWidgetFormPropelChoice(array('model' => 'IndicatorsSc', 'add_empty' => true)),
      'flag'         => new sfWidgetFormFilterInput(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'create_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'update_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'grupo_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GrupoTrabajoSc', 'column' => 'id')),
      'email'        => new sfValidatorPass(array('required' => false)),
      'tree_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TreeSc', 'column' => 'id')),
      'indicador_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'IndicatorsSc', 'column' => 'id')),
      'flag'         => new sfValidatorPass(array('required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'create_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'update_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('asignacion_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AsignacionSc';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'grupo_id'     => 'ForeignKey',
      'email'        => 'Text',
      'tree_id'      => 'ForeignKey',
      'indicador_id' => 'ForeignKey',
      'flag'         => 'Text',
      'user_id'      => 'ForeignKey',
      'create_at'    => 'Date',
      'update_at'    => 'Date',
    );
  }
}
