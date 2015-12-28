<?php

/**
 * TmpTreeSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTmpTreeScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'valor_minimo'   => new sfWidgetFormFilterInput(),
      'valor_deseado'  => new sfWidgetFormFilterInput(),
      'configure_flag' => new sfWidgetFormFilterInput(),
      'flag'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'valor_minimo'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_deseado'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'configure_flag' => new sfValidatorPass(array('required' => false)),
      'flag'           => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tmp_tree_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TmpTreeSc';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'valor_minimo'   => 'Number',
      'valor_deseado'  => 'Number',
      'configure_flag' => 'Text',
      'flag'           => 'Text',
    );
  }
}
