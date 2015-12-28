<?php

/**
 * DetalleGrupoTrabajoSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseDetalleGrupoTrabajoScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'email'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'grupo_id' => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'email'    => new sfValidatorPass(array('required' => false)),
      'user_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'grupo_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GrupoTrabajoSc', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('detalle_grupo_trabajo_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DetalleGrupoTrabajoSc';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'email'    => 'Text',
      'user_id'  => 'ForeignKey',
      'grupo_id' => 'ForeignKey',
    );
  }
}
