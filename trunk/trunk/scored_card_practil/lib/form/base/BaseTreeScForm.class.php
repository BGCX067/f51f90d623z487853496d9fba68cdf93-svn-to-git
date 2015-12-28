<?php

/**
 * TreeSc form base class.
 *
 * @method TreeSc getObject() Returns the current form's model object
 *
 * @package    practil_scorecard
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTreeScForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'name'              => new sfWidgetFormTextarea(),
      'descripcion'       => new sfWidgetFormTextarea(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => false)),
      'grupo_trabajo_id'  => new sfWidgetFormPropelChoice(array('model' => 'GrupoTrabajoSc', 'add_empty' => true)),
      'periodo_id'        => new sfWidgetFormPropelChoice(array('model' => 'PeriodoSc', 'add_empty' => true)),
      'responsable_id'    => new sfWidgetFormPropelChoice(array('model' => 'UserSc', 'add_empty' => true)),
      'email_responsable' => new sfWidgetFormInputText(),
      'valor_minimo'      => new sfWidgetFormInputText(),
      'valor_deseado'     => new sfWidgetFormInputText(),
      'configure_flag'    => new sfWidgetFormTextarea(),
      'flag'              => new sfWidgetFormTextarea(),
      'create_at'         => new sfWidgetFormDateTime(),
      'update_at'         => new sfWidgetFormDateTime(),
      'configure_design'  => new sfWidgetFormTextarea(),
      'produccion'        => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'              => new sfValidatorString(array('required' => false)),
      'descripcion'       => new sfValidatorString(array('required' => false)),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id')),
      'grupo_trabajo_id'  => new sfValidatorPropelChoice(array('model' => 'GrupoTrabajoSc', 'column' => 'id', 'required' => false)),
      'periodo_id'        => new sfValidatorPropelChoice(array('model' => 'PeriodoSc', 'column' => 'id', 'required' => false)),
      'responsable_id'    => new sfValidatorPropelChoice(array('model' => 'UserSc', 'column' => 'id', 'required' => false)),
      'email_responsable' => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'valor_minimo'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'valor_deseado'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'configure_flag'    => new sfValidatorString(array('required' => false)),
      'flag'              => new sfValidatorString(array('required' => false)),
      'create_at'         => new sfValidatorDateTime(array('required' => false)),
      'update_at'         => new sfValidatorDateTime(array('required' => false)),
      'configure_design'  => new sfValidatorString(array('required' => false)),
      'produccion'        => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tree_sc[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TreeSc';
  }


}
