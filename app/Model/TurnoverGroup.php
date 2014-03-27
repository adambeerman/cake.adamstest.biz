<?php
App::uses('AppModel', 'Model');
App::uses('CakeTime', 'Utility');
/**
 * TurnoverGroup Model
 *
 * @property BusinessUnit $BusinessUnit
 * @property Refinery $Refinery
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


    public function get_shift_starts($id = null) {
        # Return array of startTimes

        $numShifts = $this->Turnover->get_num_shifts($id);

        $conditions = array(
            'TurnoverGroup.id' => $id
        );

        for($i = 1; $i <= $numShifts; $i++) {
            $shiftStarts[$i] = $this->field('shift_start_'.$i, $conditions);

            //Concatenate today's date with the shift start
            //$shiftStartTime = date('Y-m-d',time()).' '.$startTime[$i];

            // This will eventually [NEED TO] be updated with the time zone for the user group
            //$shiftStart[$i] = CakeTime::toUnix($shiftStartTime, $this->field('timezone'));
        }

        return $shiftStarts;
    }

    public function get_shift_label($id = null, $idx = null) {

        $numShifts = $this->Turnover->get_num_shifts($id);
        $idx_start = date('Y-m-d', 0);

        $conditions = array(
            'TurnoverGroup.id' => $id
        );

        # if idx is not set, then default to using the current time()

        if(!isset($idx)){
            // Get time in H:M:S format
            $time = date('H:i:s', time());
            $date = date('m/d/y', time());

            $shiftStarts = $this->get_shift_starts($id);

            // Collect

            $labelIdx = $numShifts;

            if ($time < $shiftStarts[1]) {
                $labelIdx = $numShifts;
            }
            else if ($time < $shiftStarts[2]){
                $labelIdx = 1;
            }
            else {
                $labelIdx = $numShifts;
            }

            $shiftLabel = $this->field('shift_name_'.$labelIdx, $conditions);

        } else {
            // Find out where this idx would fit in time

            // Grab date approximation (does not account for daylight savings time);
            $date = date('m/d/y',($idx*(24*60*60/$numShifts)-12*60*60));
            $shift = $idx%$numShifts;

            if($shift == 0) {
                $shiftLabel = $this->field('shift_name_1', $conditions);
            }
            elseif ($shift == 1) {
                $shiftLabel = $this->field('shift_name_2', $conditions);
            }
            elseif ($shift == 2) {
                $shiftLabel = $this->field('shift_name_3', $conditions);
            }
            else {
                $shiftLabel = $this->field('shift_name_4', $conditions);
            }
        }

        return $shiftLabel." - ".$date;

    }
}
