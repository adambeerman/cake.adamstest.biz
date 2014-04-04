<?php
App::uses('AppController', 'Controller');
/**
 * Pfds Controller
 *
 * @property Pfd $Pfd
 * @property PaginatorComponent $Paginator
 */
class PfdsController extends AppController {

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
		$this->Pfd->recursive = 0;
		$this->set('pfds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pfd->exists($id)) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		$options = array('conditions' => array('Pfd.' . $this->Pfd->primaryKey => $id));
		$this->set('pfd', $this->Pfd->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pfd->create();
			if ($this->Pfd->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd could not be saved. Please, try again.'));
			}
		}
		$plants = $this->Pfd->Plant->find('list');
		$users = $this->Pfd->User->find('list');
		$this->set(compact('plants', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Pfd->exists($id)) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pfd->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pfd.' . $this->Pfd->primaryKey => $id));
			$this->request->data = $this->Pfd->find('first', $options);
		}
		$plants = $this->Pfd->Plant->find('list');
		$users = $this->Pfd->User->find('list');
		$this->set(compact('plants', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Pfd->id = $id;
		if (!$this->Pfd->exists()) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pfd->delete()) {
			$this->Session->setFlash(__('The pfd has been deleted.'));
		} else {
			$this->Session->setFlash(__('The pfd could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Pfd->recursive = 0;
		$this->set('pfds', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Pfd->exists($id)) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		$options = array('conditions' => array('Pfd.' . $this->Pfd->primaryKey => $id));
		$this->set('pfd', $this->Pfd->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Pfd->create();
			if ($this->Pfd->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd could not be saved. Please, try again.'));
			}
		}
		$plants = $this->Pfd->Plant->find('list');
		$users = $this->Pfd->User->find('list');
		$this->set(compact('plants', 'users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Pfd->exists($id)) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Pfd->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pfd.' . $this->Pfd->primaryKey => $id));
			$this->request->data = $this->Pfd->find('first', $options);
		}
		$plants = $this->Pfd->Plant->find('list');
		$users = $this->Pfd->User->find('list');
		$this->set(compact('plants', 'users'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Pfd->id = $id;
		if (!$this->Pfd->exists()) {
			throw new NotFoundException(__('Invalid pfd'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pfd->delete()) {
			$this->Session->setFlash(__('The pfd has been deleted.'));
		} else {
			$this->Session->setFlash(__('The pfd could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
