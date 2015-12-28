<?php

/**
 * SolicitudGrupoTrabajoSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSolicitudGrupoTrabajoScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'grupo_id'   => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'email'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'create_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'update_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'token'      => new sfWidgetFormFilterInput(),
      'flag'       => new sfWidgetFormFilterInput(),
      'respondido' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'grupo_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GrupoTrabajoSc', 'column' => 'id')),
      'email'      => new sfValidatorPass(array('required' => false)),
      'create_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'update_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'token'      => new sfValidatorPass(array('required' => false)),
      'flag'       => new sfValidatorPass(array('required' => false)),
      'respondido' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('solicitud_grupo_trabajo_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SolicitudGrupoTrabajoSc';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'grupo_id'   => 'ForeignKey',
      'email'      => 'Text',
      'create_at'  => 'Date',
      'update_at'  => 'Date',
      'user_id'    => 'ForeignKey',
      'token'      => 'Text',
      'flag'       => 'Text',
      'respondido' => 'Number',
    );
  }
}
