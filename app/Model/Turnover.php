<?php
App::uses('AppModel', 'Model');
/**
 * Turnover Model
 *
 * @property TurnoverGroup $TurnoverGroup
 * @property User $User
 */
class Turnover extends AppModel {

    public $scaffold = 'admin';

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
		'turnover_group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'content' => array(
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
		'TurnoverGroup' => array(
			'className' => 'TurnoverGroup',
			'foreignKey' => 'turnover_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    //Copying this function from the example provided for posts in CakePHP.
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }


    // Used to set the Turnover Index
    public function set_turnover_idx($to_grp_id = null) {
        // This sets the turnover index for a turnover
        // This is used for grouping turnovers of a similar shift for navigating turnover groups
        # starting point is 1970-1-1 @ midnight

        // $to_grp_id will be used to get the exact starting shift time

        $idx_start = date('Y-m-d', 0);

        $conditions = array(
            'TurnoverGroup.id' => $to_grp_id
        );

        $num_shifts = $this->get_num_shifts($to_grp_id);

        $midnight = date('Y-m-d', time());

        $date1=date_create($idx_start);
        $date2=date_create($midnight);
        $diff=date_diff($date1,$date2);

        $days = $diff->days;
        $shifts = $days * $num_shifts;

        // Compile shift start times into an array called $start
        $time = date('h:i:s', time());
        for($i=1;$i<=$num_shifts;$i++) {
            $start[$i] = $this->TurnoverGroup->field('shift_start_'.$i, $conditions);
        }

        //Need to validate if these properly adjust for the different shift times

        // Find index correction based on number of shifts elapsed in the day
        $idx_correct=0;
        for($j=1;$j<=$num_shifts;$j++) {
            if($time > $start[$j]){
                $idx_correct++;
            }
        }

        return $shifts+$idx_correct;

    }

    public function get_num_shifts($turnover_group_id = null) {
        $conditions = array(
            'TurnoverGroup.id' => $turnover_group_id
        );

        $num_shifts = $this->TurnoverGroup->field('num_shifts', $conditions);
        return $num_shifts;
    }
}
