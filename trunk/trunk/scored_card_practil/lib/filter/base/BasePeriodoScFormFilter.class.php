<?php

/**
 * PeriodoSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePeriodoScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'descripcion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'flag'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'flag'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('periodo_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PeriodoSc';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'descripcion' => 'Text',
      'flag'        => 'Text',
    );
  }
}
