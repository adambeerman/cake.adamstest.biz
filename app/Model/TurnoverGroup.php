<?php
App::uses('AppModel', 'Model');
/**
 * TurnoverGroup Model
 *
 * @property BusinessUnit $BusinessUnit
 * @property Refinery $Refinery
 * @property ShiftCycle $ShiftCycle
 * @property Turnover $Turnover
 */
class TurnoverGroup extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'test';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'BusinessUnit' => array(
			'className' => 'BusinessUnit',
			'foreignKey' => 'business_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Refinery' => array(
			'className' => 'Refinery',
			'foreignKey' => 'refinery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ShiftCycle' => array(
			'className' => 'ShiftCycle',
			'foreignKey' => 'shift_cycle_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Turnover' => array(
			'className' => 'Turnover',
			'foreignKey' => 'turnover_group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
