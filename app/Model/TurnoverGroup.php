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

        'business_unit_id' =>array(),
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
		),
	);


    public function get_shift_starts($id = null, $numShifts = null) {
        # Returns an array of shift starting times
        for($i = 1; $i <= $numShifts; $i++) {
            $startTime[$i] = $this->ShiftCycle->field('shift_start_'.$i);

            //Concatenate today's date with the shift start
            $shiftStartTime = date('Y-m-d',time()).' '.$startTime[$i];

            // This will eventually [NEED TO] be updated with the time zone for the user group
            $shiftStart[$i] = CakeTime::toUnix($shiftStartTime, $this->field('timezone'));
        }

        return $shiftStart;
    }

    public function get_shift_label($shiftStart = null) {

        #Based on $shiftStart times provided, determines what the label is for a turnover created right now

        $j = 1;
        if(time() < $shiftStart[$j]) {
            // Display "Night Shift" plus the previous day's date
            $shiftLabel = "Night Shift - ".date('m/d/y', time()-60*60*24);
        }
        elseif(time()<$shiftStart[$j+1]){
            $shiftLabel = "Day Shift - ".date('m/d/y', time());
        }
        else {
            $shiftLabel = "Night Shift - ".date('m/d/y', time());
        }

        return $shiftLabel;
    }

}
