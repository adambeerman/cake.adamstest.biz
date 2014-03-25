<?php
App::uses('AppController', 'Controller');
/**
 * ShiftCycles Controller
 *
 * @property ShiftCycle $ShiftCycle
 * @property PaginatorComponent $Paginator
 */
class ShiftCyclesController extends AppController {

    public $scaffold = 'admin';
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
		$this->ShiftCycle->recursive = 0;
		$this->set('shiftCycles', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ShiftCycle->exists($id)) {
			throw new NotFoundException(__('Invalid shift cycle'));
		}
		$options = array('conditions' => array('ShiftCycle.' . $this->ShiftCycle->primaryKey => $id));
		$this->set('shiftCycle', $this->ShiftCycle->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ShiftCycle->create();
			if ($this->ShiftCycle->save($this->request->data)) {
				$this->Session->setFlash(__('The shift cycle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift cycle could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ShiftCycle->exists($id)) {
			throw new NotFoundException(__('Invalid shift cycle'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShiftCycle->save($this->request->data)) {
				$this->Session->setFlash(__('The shift cycle has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shift cycle could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ShiftCycle.' . $this->ShiftCycle->primaryKey => $id));
			$this->request->data = $this->ShiftCycle->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ShiftCycle->id = $id;
		if (!$this->ShiftCycle->exists()) {
			throw new NotFoundException(__('Invalid shift cycle'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ShiftCycle->delete()) {
			$this->Session->setFlash(__('The shift cycle has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shift cycle could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
