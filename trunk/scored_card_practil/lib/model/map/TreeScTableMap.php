<?php


/**
 * This class defines the structure of the 'tree_sc' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * 11/28/11 15:03:11
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class TreeScTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.TreeScTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('tree_sc');
		$this->setPhpName('TreeSc');
		$this->setClassname('TreeSc');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'LONGVARCHAR', false, null, null);
		$this->addColumn('DESCRIPCION', 'Descripcion', 'LONGVARCHAR', false, null, null);
		$this->addForeignKey('USER_ID', 'UserId', 'INTEGER', 'user_sc', 'ID', true, null, null);
		$this->addForeignKey('GRUPO_TRABAJO_ID', 'GrupoTrabajoId', 'INTEGER', 'grupo_trabajo_sc', 'ID', false, null, null);
		$this->addForeignKey('PERIODO_ID', 'PeriodoId', 'INTEGER', 'periodo_sc', 'ID', false, null, null);
		$this->addForeignKey('RESPONSABLE_ID', 'ResponsableId', 'INTEGER', 'user_sc', 'ID', false, null, null);
		$this->addColumn('EMAIL_RESPONSABLE', 'EmailResponsable', 'VARCHAR', false, 50, null);
		$this->addColumn('VALOR_MINIMO', 'ValorMinimo', 'INTEGER', false, null, null);
		$this->addColumn('VALOR_DESEADO', 'ValorDeseado', 'INTEGER', false, null, null);
		$this->addColumn('CONFIGURE_FLAG', 'ConfigureFlag', 'LONGVARCHAR', false, null, null);
		$this->addColumn('FLAG', 'Flag', 'LONGVARCHAR', false, null, null);
		$this->addColumn('CREATE_AT', 'CreateAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATE_AT', 'UpdateAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('CONFIGURE_DESIGN', 'ConfigureDesign', 'LONGVARCHAR', false, null, null);
		$this->addColumn('PRODUCCION', 'Produccion', 'LONGVARCHAR', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('UserScRelatedByUserId', 'UserSc', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
    $this->addRelation('GrupoTrabajoSc', 'GrupoTrabajoSc', RelationMap::MANY_TO_ONE, array('grupo_trabajo_id' => 'id', ), null, null);
    $this->addRelation('PeriodoSc', 'PeriodoSc', RelationMap::MANY_TO_ONE, array('periodo_id' => 'id', ), null, null);
    $this->addRelation('UserScRelatedByResponsableId', 'UserSc', RelationMap::MANY_TO_ONE, array('responsable_id' => 'id', ), null, null);
    $this->addRelation('TreeUser', 'TreeUser', RelationMap::ONE_TO_MANY, array('id' => 'tree_id', ), null, null);
    $this->addRelation('IndicatorsSc', 'IndicatorsSc', RelationMap::ONE_TO_MANY, array('id' => 'tree_id', ), null, null);
    $this->addRelation('AsignacionSc', 'AsignacionSc', RelationMap::ONE_TO_MANY, array('id' => 'tree_id', ), null, null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // TreeScTableMap
