<?php
App::uses('AppController', 'Controller');
/**
 * UnitTypes Controller
 *
 * @property UnitType $UnitType
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UnitTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
    public $scaffold = 'admin';
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->UnitType->recursive = 0;
		$this->set('unitTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UnitType->exists($id)) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		$options = array('conditions' => array('UnitType.' . $this->UnitType->primaryKey => $id));
		$this->set('unitType', $this->UnitType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnitType->create();
			if ($this->UnitType->save($this->request->data)) {
				$this->Session->setFlash(__('The unit type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit type could not be saved. Please, try again.'));
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
		if (!$this->UnitType->exists($id)) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UnitType->save($this->request->data)) {
				$this->Session->setFlash(__('The unit type has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unit type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UnitType.' . $this->UnitType->primaryKey => $id));
			$this->request->data = $this->UnitType->find('first', $options);
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
		$this->UnitType->id = $id;
		if (!$this->UnitType->exists()) {
			throw new NotFoundException(__('Invalid unit type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UnitType->delete()) {
			$this->Session->setFlash(__('The unit type has been deleted.'));
		} else {
			$this->Session->setFlash(__('The unit type could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
