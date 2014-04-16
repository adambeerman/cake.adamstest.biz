<?php
App::uses('AppController', 'Controller');
/**
 * Turnovers Controller
 *
 * @property Turnover $Turnover
 * @property PaginatorComponent $Paginator
 */
class TurnoversController extends AppController {

    public $scaffold = 'admin';
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Turnover->recursive = 0;
		$this->set('turnovers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Turnover->exists($id)) {
			throw new NotFoundException(__('Invalid turnover'));
		}
		$options = array('conditions' => array('Turnover.' . $this->Turnover->primaryKey => $id));
		$this->set('turnover', $this->Turnover->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($turnover_group_id=null, $user_id = null) {

        $this->autoRender = false;

        if($this->request->is('post', 'ajax')) {

			$this->Turnover->create();
            $this->request->data('Turnover.turnover_group_id', $turnover_group_id);

            // Handle User ID, whether ot not it was passed to /turnovers/add
            if($user_id == null){
                $this->request->data('Turnover.user_id', $this->Auth->user('id'));
            }
            else {
                $this->request->data('Turnover.user_id', $user_id);
            }

            // Setting Turnover Index - However, what if this is already set and you are adding a past turnover?
            $this->request->data('Turnover.turnover_idx',
                $this->Turnover->set_turnover_idx($this->request->data('Turnover.turnover_group_id')));

			if ($this->Turnover->save($this->request->data)) {
                if($this->request->is('ajax')){

                    // Render the turnover element, while passing in the latest turnover information!
                    $this->request->data('Turnover.id', $this->Turnover->id);
                    $this->set('turnover', $this->request->data);
                    $this->render('/Elements/turnover');
                }
                else {
                    $this->Session->setFlash(__('The turnover has been saved.'));
                    $this->render('success', 'ajax');
                    //return $this->redirect(array('controller' => 'turnover_groups', 'action' => 'view', $turnover_group_id));
                }
			}
		}

        $this->request->data['Turnover']['user_id'] = $user_id;
        $this->request->data['Turnover']['turnover_group_id'] = $turnover_group_id;

        // Shouldn't need to pass in the turnover group and user lists. We will already know this.
		//$turnoverGroups = $this->Turnover->TurnoverGroup->find('list');
		//$users = $this->Turnover->User->find('list');
		$this->set(compact('turnoverGroups', 'users'));


        }# End of Method add
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Turnover->exists($id)) {
			throw new NotFoundException(__('Invalid turnover'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Turnover->save($this->request->data)) {
				$this->Session->setFlash(__('The turnover has been saved.'));
				return $this->redirect('/turnover_groups/view/'.$this->request->data['Turnover']['turnover_group_id']);
                //return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The turnover could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Turnover.' . $this->Turnover->primaryKey => $id));
			$this->request->data = $this->Turnover->find('first', $options);
		}
		$turnoverGroups = $this->Turnover->TurnoverGroup->find('list');
		$users = $this->Turnover->User->find('list');
		$this->set(compact('turnoverGroups', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Turnover->id = $id;
		if (!$this->Turnover->exists()) {
			throw new NotFoundException(__('Invalid turnover'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Turnover->delete()) {
			$this->Session->setFlash(__('The turnover has been deleted.'));
		} else {
			$this->Session->setFlash(__('The turnover could not be deleted. Please, try again.'));
		}
		return $this->redirect($this->referer());
	}}
