<?php

/**
 * IndicatorsSc filter form base class.
 *
 * @package    practil_scorecard
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseIndicatorsScFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'titulo'                      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descripcion'                 => new sfWidgetFormFilterInput(),
      'valor_minimo'                => new sfWidgetFormFilterInput(),
      'valor_deseado'               => new sfWidgetFormFilterInput(),
      'valor_optimo'                => new sfWidgetFormFilterInput(),
      'responsable_id'              => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'tree_id'                     => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => true)),
      'previous_id'                 => new sfWidgetFormFilterInput(),
      'parents'                     => new sfWidgetFormFilterInput(),
      'indicadores_hijos_configure' => new sfWidgetFormFilterInput(),
      'ultimo_nodo'                 => new sfWidgetFormFilterInput(),
      'valor_actual_entregado'      => new sfWidgetFormFilterInput(),
      'conectores_configure'        => new sfWidgetFormFilterInput(),
      'owner_indicadores'           => new sfWidgetFormFilterInput(),
      'email_responsable'           => new sfWidgetFormFilterInput(),
      'flag'                        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'titulo'                      => new sfValidatorPass(array('required' => false)),
      'descripcion'                 => new sfValidatorPass(array('required' => false)),
      'valor_minimo'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_deseado'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'valor_optimo'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'responsable_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'UserSc', 'column' => 'id')),
      'tree_id'                     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TreeSc', 'column' => 'id')),
      'previous_id'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'parents'                     => new sfValidatorPass(array('required' => false)),
      'indicadores_hijos_configure' => new sfValidatorPass(array('required' => false)),
      'ultimo_nodo'                 => new sfValidatorPass(array('required' => false)),
      'valor_actual_entregado'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'conectores_configure'        => new sfValidatorPass(array('required' => false)),
      'owner_indicadores'           => new sfValidatorPass(array('required' => false)),
      'email_responsable'           => new sfValidatorPass(array('required' => false)),
      'flag'                        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('indicators_sc_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IndicatorsSc';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'titulo'                      => 'Text',
      'descripcion'                 => 'Text',
      'valor_minimo'                => 'Number',
      'valor_deseado'               => 'Number',
      'valor_optimo'                => 'Number',
      'responsable_id'              => 'ForeignKey',
      'tree_id'                     => 'ForeignKey',
      'previous_id'                 => 'Number',
      'parents'                     => 'Text',
      'indicadores_hijos_configure' => 'Text',
      'ultimo_nodo'                 => 'Text',
      'valor_actual_entregado'      => 'Number',
      'conectores_configure'        => 'Text',
      'owner_indicadores'           => 'Text',
      'email_responsable'           => 'Text',
      'flag'                        => 'Text',
    );
  }
}
