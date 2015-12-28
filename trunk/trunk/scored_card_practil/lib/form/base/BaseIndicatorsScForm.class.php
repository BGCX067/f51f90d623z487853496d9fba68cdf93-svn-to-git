<?php

/**
 * IndicatorsSc form base class.
 *
 * @method IndicatorsSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseIndicatorsScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'titulo'                      => new sfWidgetFormInputText(),
      'descripcion'                 => new sfWidgetFormTextarea(),
      'valor_minimo'                => new sfWidgetFormInputText(),
      'valor_deseado'               => new sfWidgetFormInputText(),
      'valor_optimo'                => new sfWidgetFormInputText(),
      'responsable_id'              => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'tree_id'                     => new sfWidgetFormPropelChoice(array('model' => 'TreeSc', 'add_empty' => false)),
      'previous_id'                 => new sfWidgetFormInputText(),
      'parents'                     => new sfWidgetFormTextarea(),
      'indicadores_hijos_configure' => new sfWidgetFormTextarea(),
      'ultimo_nodo'                 => new sfWidgetFormInputText(),
      'valor_actual_entregado'      => new sfWidgetFormInputText(),
      'conectores_configure'        => new sfWidgetFormTextarea(),
      'owner_indicadores'           => new sfWidgetFormTextarea(),
      'email_responsable'           => new sfWidgetFormInputText(),
      'flag'                        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'titulo'                      => new sfValidatorString(array('max_length' => 250)),
      'descripcion'                 => new sfValidatorString(array('required' => false)),
      'valor_minimo'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_deseado'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_optimo'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'responsable_id'              => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id', 'required' => false)),
      'tree_id'                     => new sfValidatorPropelChoice(array('model' => 'TreeSc', 'column' => 'id')),
      'previous_id'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'parents'                     => new sfValidatorString(array('required' => false)),
      'indicadores_hijos_configure' => new sfValidatorString(array('required' => false)),
      'ultimo_nodo'                 => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'valor_actual_entregado'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'conectores_configure'        => new sfValidatorString(array('required' => false)),
      'owner_indicadores'           => new sfValidatorString(array('required' => false)),
      'email_responsable'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'flag'                        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('indicators_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'IndicatorsSc';
  }


}
