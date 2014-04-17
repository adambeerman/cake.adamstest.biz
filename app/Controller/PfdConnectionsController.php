<?php
App::uses('AppController', 'Controller');
/**
 * PfdConnections Controller
 *
 * @property PfdConnection $PfdConnection
 * @property PaginatorComponent $Paginator
 * @property RequestHandlerComponent $RequestHandler
 * @property SessionComponent $Session
 */
class PfdConnectionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PfdConnection->recursive = 0;
		$this->set('pfdConnections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PfdConnection->exists($id)) {
			throw new NotFoundException(__('Invalid pfd connection'));
		}
		$options = array('conditions' => array('PfdConnection.' . $this->PfdConnection->primaryKey => $id));
		$this->set('pfdConnection', $this->PfdConnection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post','ajax')) {
			$this->PfdConnection->create();
			if ($this->PfdConnection->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd connection could not be saved. Please, try again.'));
			}
		}
		$pfds = $this->PfdConnection->Pfds->find('list');
		$pfdItemAs = $this->PfdConnection->PfdItemA->find('list');
		$pfdItemBs = $this->PfdConnection->PfdItemB->find('list');
		$this->set(compact('pfds', 'pfdItemAs', 'pfdItemBs'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PfdConnection->exists($id)) {
			throw new NotFoundException(__('Invalid pfd connection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PfdConnection->save($this->request->data)) {
				$this->Session->setFlash(__('The pfd connection has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pfd connection could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('PfdConnection.' . $this->PfdConnection->primaryKey => $id));
			$this->request->data = $this->PfdConnection->find('first', $options);
		}
		$pfds = $this->PfdConnection->Pfd->find('list');
		$pfdItemAs = $this->PfdConnection->PfdItemA->find('list');
		$pfdItemBs = $this->PfdConnection->PfdItemB->find('list');
		$this->set(compact('pfds', 'pfdItemAs', 'pfdItemBs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PfdConnection->id = $id;
		if (!$this->PfdConnection->exists()) {
			throw new NotFoundException(__('Invalid pfd connection'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PfdConnection->delete()) {
			$this->Session->setFlash(__('The pfd connection has been deleted.'));
		} else {
			$this->Session->setFlash(__('The pfd connection could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
