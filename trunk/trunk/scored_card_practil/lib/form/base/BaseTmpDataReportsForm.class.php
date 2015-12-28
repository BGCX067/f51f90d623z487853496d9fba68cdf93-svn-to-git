<?php

/**
 * TmpDataReports form base class.
 *
 * @method TmpDataReports getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTmpDataReportsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'indicador_id'                => new sfWidgetFormInputText(),
      'valor_minimo'                => new sfWidgetFormInputText(),
      'valor_deseado'               => new sfWidgetFormInputText(),
      'valor_optimo'                => new sfWidgetFormInputText(),
      'tree_id'                     => new sfWidgetFormPropelChoice(array('model' => 'TmpTreeSc', 'add_empty' => false)),
      'previous_id'                 => new sfWidgetFormInputText(),
      'parents'                     => new sfWidgetFormTextarea(),
      'indicadores_hijos_configure' => new sfWidgetFormTextarea(),
      'ultimo_nodo'                 => new sfWidgetFormInputText(),
      'data'                        => new sfWidgetFormInputText(),
      'conectores_configure'        => new sfWidgetFormTextarea(),
      'update_at'                   => new sfWidgetFormDateTime(),
      'flag'                        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'indicador_id'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_minimo'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_deseado'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_optimo'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'tree_id'                     => new sfValidatorPropelChoice(array('model' => 'TmpTreeSc', 'column' => 'id')),
      'previous_id'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'parents'                     => new sfValidatorString(array('required' => false)),
      'indicadores_hijos_configure' => new sfValidatorString(array('required' => false)),
      'ultimo_nodo'                 => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'data'                        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'conectores_configure'        => new sfValidatorString(array('required' => false)),
      'update_at'                   => new sfValidatorDateTime(array('required' => false)),
      'flag'                        => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tmp_data_reports[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TmpDataReports';
  }


}
