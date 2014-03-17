<?php
App::uses('AppController', 'Controller');
/**
 * TurnoverGroups Controller
 *
 * @property TurnoverGroup $TurnoverGroup
 * @property PaginatorComponent $Paginator
 */
class TurnoverGroupsController extends AppController {

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
	public function index() {
		$this->TurnoverGroup->recursive = 0;
		$this->set('turnoverGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TurnoverGroup->exists($id)) {
			throw new NotFoundException(__('Invalid turnover group'));
		}
		$options = array('conditions' => array('TurnoverGroup.' . $this->TurnoverGroup->primaryKey => $id));
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
	}}
