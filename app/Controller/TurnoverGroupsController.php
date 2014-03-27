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

        // $id is the turnover_group_id
        // $idx is the integer index, essentially a count up from the starting set

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
        $this->set('currentTime', time());

        //Get num shifts
        $numShifts = $this->TurnoverGroup->Turnover->get_num_shifts($id);

        // Find & Set shift start times
        $shiftStarts = $this->TurnoverGroup->get_shift_starts($id, $numShifts);
        $this->set('startTimes',$shiftStarts);

        // Find & Set shift labels for Turnover Group View page
        // [NEED TO] if the $idx has been specified, need to find the new shift name

        $shiftLabel = $this->TurnoverGroup->get_shift_label($id, $idx);


        $this->set('shift', $shiftLabel);

        // If an index is provided, use it. Otherwise, find what the current index is
        if(!isset($idx)){
            $idx = $this->TurnoverGroup->Turnover->set_turnover_idx($id);
        }

        //Pass index to view for creating new links
        $this->set('idx',$idx);

        $turnovers = $this->TurnoverGroup->Turnover->query(
            'SELECT * FROM turnovers AS Turnover WHERE Turnover.turnover_group_id = '.$id.' AND
                Turnover.turnover_idx = '.$idx.';');

        $this->set('turnovers', $turnovers);

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
		$this->set(compact('businessUnits', 'refineries'));
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
		$this->set(compact('businessUnits', 'refineries'));
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
