<?php
App::uses('AppController','Controller');
App::uses('CakeTime','Utility');
/**
 * TurnoverGroups Controller
 *
 * @property TurnoverGroup $TurnoverGroup
 * @property PaginatorComponent $Paginator
 */
class TurnoverGroupsController extends AppController {

    public $scaffold = 'admin';
    public $helpers = array('Time', 'Html', 'Js');
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($hist = NULL) {
		$this->TurnoverGroup->recursive = 0;
        $this->set('turnoverGroups', $this->TurnoverGroup->find('all'));
		//$this->set('turnoverGroups', $this->Paginator->paginate());



        $this->set('test', $this->Auth->user());
        $paramUser = array('conditions' => array('User.id' => $this->Auth->user('id')),
        'recursive' => -1);
        $this->set('userInfo', $this->TurnoverGroup->Turnover->User->find('first', $paramUser));

        // Find My Turnovers
        $paramMine = array('conditions' => array('Turnover.user_id' =>  $this->Auth->user('id')),
            'recursive' => -1);
        $this->set('myTOs', $this->TurnoverGroup->Turnover->find('all', $paramMine));

        // Find Business Unit Turnover
        $paramBU = array('conditions' => array('TurnoverGroup.business_unit_id' => $this->Auth->user('business_unit_id')),
            'recursive' => -1);
        $this->set('businessUnitTOs', $this->TurnoverGroup->find('all', $paramBU));


        // Find Latest Refinery Turnovers
        $paramRefinery = array('conditions' => array('TurnoverGroup.refinery_id' => $this->Auth->user('refinery_id')),
            'recursive' => -1);
        $this->set('refineryTOs', $this->TurnoverGroup->find('all', $paramRefinery));

        //Find Today's Turnovers
        //$paramToday = array('conditions' => array('created > ', ));


        // Need place to select from different business units
        // $this->set('businessUnitTOs',$this->TurnoverGroup->BusinessUnit->find('all'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null, $idx = null) {

        /* Turnover Group View

        User will have navigated here from an index page, containing the group id
        This should populate with the current shift's turnover, unless another date is entered
        A TurnoverGroup belongs to a certain shift-cycle, so we can check which shift-cycle we're in...


        [NEED TO] create a new model for TurnoverIndex:
        # This will assign a unique index to each shift
        # Will allow user to easily step back through time, without filtering through dates
        # Queries will be more simple: 'WHERE idx = $var';
        # Will be allowed to go negative, since user will be able to populate historic data
        # if $idx is empty, default to the current
        */

		if (!$this->TurnoverGroup->exists($id)) {
			throw new NotFoundException(__('Invalid turnover group'));
		}

        //Current Time
        $currentTime = time();
        $this->set('currentTime', $currentTime);

        //Number of shifts - what if this is not a number?
        $numShifts = $this->TurnoverGroup->ShiftCycle->field('num_shifts');

        $step = 24*60*60/$numShifts;



        // Pull in the general shift times, and then concatenate them with $midnight variable
        $i = 1;
        while ($i <= $numShifts) {
            $startTime[$i] = $this->TurnoverGroup->ShiftCycle->field('shift_start_'.$i);

            //Instead of creating a midnight tag, we'll use current date + shift time
            $shiftStartTime = date('Y-m-d',$currentTime).' '.$startTime[$i];

            //Currently, using CakeTime::serverOffset() to determine shift times from gmt
            // This will eventually [NEED TO] be updated with the time zone for the user group
            $shiftStart[$i] = CakeTime::toUnix($shiftStartTime, 'America/New_York');
            $i++;
        }
        // $startTime is array of starting shifts.
        $this->set('startTimes',$shiftStart);

        // Determine if we are on the previous night shift, the current day shift or current night shift
        // Initially, assuming we only have 2 shifts. [NEED TO] expand to accomodate other shift types
        $j = 1;

        if($currentTime < $shiftStart[$j]) {

            // Display "Night Shift" plus the previous day's date
            $shift = "Night Shift - ".date('m/d/y', $currentTime-60*60*24);
            $start = $shiftStart[$j] - 60*60*24/$numShifts;

            $search = '(created BETWEEN '.$start.' AND '.$shiftStart[$j].');';
        }
        elseif($currentTime<$shiftStart[$j+1]){
            $shift = "Day Shift - ".date('m/d/y', $currentTime);
            $search = '(created BETWEEN '.$shiftStart[$j].' AND '.$shiftStart[$j+1].');';
        }
        else {
            $shift = "Night Shift - ".date('m/d/y', $currentTime);
            $search = 'created > '.$shiftStart[$j+1].';';
        }

        $this->set('shift', $shift);

        //Query the database:

        $turnovers = $this->TurnoverGroup->Turnover->query(
            'SELECT * FROM turnovers AS Turnover WHERE Turnover.turnover_group_id = '.$id. ' AND '.$search.' created DESC'
        );

        // Find all the turnovers for the current shift
        $this->set('turnovers', $turnovers); //$this->TurnoverGroup->Turnover->find('all', $params));
        $options = array('conditions' => array('TurnoverGroup.id' => $id),
            'recursive' => -1);
        $this->set('turnoverGroup', $this->TurnoverGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TurnoverGroup->create();
			if ($this->TurnoverGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The turnover group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The turnover group could not be saved. Please, try again.'));
			}
		}

        // Only allow business units within the User's refinery

        $params = array('conditions' => array());

		$businessUnits = $this->TurnoverGroup->BusinessUnit->find('list');
		$refineries = $this->TurnoverGroup->Refinery->find('list');
		$shiftCycles = $this->TurnoverGroup->ShiftCycle->find('list');
		$this->set(compact('businessUnits', 'refineries', 'shiftCycles'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TurnoverGroup->exists($id)) {
			throw new NotFoundException(__('Invalid turnover group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TurnoverGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The turnover group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The turnover group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TurnoverGroup.' . $this->TurnoverGroup->primaryKey => $id));
			$this->request->data = $this->TurnoverGroup->find('first', $options);
		}
		$businessUnits = $this->TurnoverGroup->BusinessUnit->find('list');
		$refineries = $this->TurnoverGroup->Refinery->find('list');
		$shiftCycles = $this->TurnoverGroup->ShiftCycle->find('list');
		$this->set(compact('businessUnits', 'refineries', 'shiftCycles'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TurnoverGroup->id = $id;
		if (!$this->TurnoverGroup->exists()) {
			throw new NotFoundException(__('Invalid turnover group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TurnoverGroup->delete()) {
			$this->Session->setFlash(__('The turnover group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The turnover group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function profile($id = null, $date = null) {

        // Should be allowed to see the turnover group profile using "get"
        // However, if you do not belong to the same company as the turnovers, then you won't have access

        //if($this->Auth->user('company_id'))

        //$this->request->onlyAllow('post', 'delete');

        $this->set('turnovers',$this->TurnoverGroup->find('all'));
    }
}
