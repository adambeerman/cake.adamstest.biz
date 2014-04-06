<?php
App::uses('AppController', 'Controller');
/**
 * PfdItems Controller
 *
 * @property PfdItem $PfdItem
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PfdItemsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PfdItem->recursive = 0;
		$this->set('pfdItems', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PfdItem->exists($id)) {
			throw new NotFoundException(__('Invalid pfd item'));
		}
		$options = array('conditions' => array('PfdItem.' . $this->PfdItem->primaryKey => $id));
		$this->set('pfdItem', $this->PfdItem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($pfd_id = null) {
		if ($this->request->is('post')) {
			$this->PfdItem->create();
            $this->request->data('PfdItem.pfd_id', $pfd_id);
			if ($this->PfdItem->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd item has been saved.'));
				return $this->redirect(array('controller' => 'pfds', 'action' => 'build', $pfd_id));
			} else {
				$this->Session->setFlash(__('The pfd item could not be saved. Please, try again.'));
			}
		}
		$pfds = $this->PfdItem->find('list');
		//$this->set(compact('pfds'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PfdItem->exists($id)) {
			throw new NotFoundException(__('Invalid pfd item'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PfdItem->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd item has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd item could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PfdItem.' . $this->PfdItem->primaryKey => $id));
			$this->request->data = $this->PfdItem->find('first', $options);
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
		$this->PfdItem->id = $id;
		if (!$this->PfdItem->exists()) {
			throw new NotFoundException(__('Invalid pfd item'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PfdItem->delete()) {
			$this->Session->setFlash(__('The pfd item has been deleted.'));
		} else {
			$this->Session->setFlash(__('The pfd item could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('controller' => 'pfds', 'action' => 'build'));
	}}
