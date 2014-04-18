<?php
App::uses('AppController', 'Controller');
/**
 * Pfd Controller
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
		//$this->set('pfds', $this->Paginator->paginate());
        $this->set('userPFDs', $this->Pfd->find('all', array('conditions' => array('Pfd.user_id' => $this->Auth->user('id')))));
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
				return $this->redirect(array('action' => 'build'));
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
			$options = array('conditions' => array('Pfds.' . $this->Pfd->primaryKey => $id));
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
		return $this->redirect(array('controller' => 'users', 'action' => 'profile'));
	}

    public function build($id = null) {

        // Purpose is to build the PFD!
        // Query the database -> find all connections and items for this $id

        $options = array(
            'conditions' => array(
                'PfdConnection.pfd_id' => $id,
            )
        );

        $options2 = array(
            'conditions' => array(
                'PfdItem.pfd_id' => $id
            )
        );

        # Gather connections
        $connections = $this->Pfd->PfdConnection->find('all', $options);
        $items = $this->Pfd->PfdItem->find('all', $options2);
        $this->set('pfd', $this->Pfd->find('first', array('conditions' => array('Pfd.id' => $id),
            'recursive' => -1 )));

        // Need an indicator of what to ask or say if the items & connections are not set.
        // This implies that we are just beginning to build the PFD.


        // If nothing set in the items ... (i.e. this is a fresh build)
        if(!isset($items[0])) {
            //$this->set('items', "Add first item or piece of equipment!");
            $this->set('initial_flag',true);
            debug($items);
        }
        else {
            $this->set('items', $items);
        }


        if(!isset($connections)) {
            $this->set('connections', "Expand your PFD");
        }
        else {
            $this->set('connections', $connections);
        }

        //$this->set('connections', $connections);
        # Gather items


    }

    public function add_connection($pfd_id = null) {

    } #end function add_connection

    public function add_item($pfd_id = null) {

    } #end function add_item


}
