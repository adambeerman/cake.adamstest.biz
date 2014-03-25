<?php
App::uses('AppModel', 'Model');
/**
 * TurnoverIndex Model
 *
 * @property TurnoverGoup $TurnoverGoup
 */
class TurnoverIndex extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'test';

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'turnover_indexes';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TurnoverGroup' => array(
			'className' => 'TurnoverGroup',
			'foreignKey' => 'turnover_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
