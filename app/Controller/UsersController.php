<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $scaffold = 'admin';
	public $components = array('Paginator', 'Session');
    public $helpers = array('Html', 'Js'); //array('Js' => array('Jquery', 'j_users_add')));

    public function beforeFilter() {
        parent::beforeFilter();

        // This sets what pages the  logged out user is allowed to view
        $this->Auth->allow('add', 'logout');
    }




    /**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		try {
            $this->set('users', $this->Paginator->paginate());
        } catch (NotFoundException $e) {
            $this->request->params['paging'];
        }
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		// The following line was baked in:
        //$this->set('user', $this->User->find('first', $options));
        $this->set('user', $this->User->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

            // Determine the company based on the e-mail address
			$this->User->create();

            // Get the company id, based on the e-mail
            // 0 is returned if no company found. To be prompted later.
            $this->request->data('User.company_id',
                $this->User->Company->find_company_from_email($this->request->data('User.email')));

            $this->request->data('User.hash', md5(rand(0,1000)));

			if ($this->User->save($this->request->data)) {
                //$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
				//$this->Session->setFlash(__($msg));
                $this->Session->setFlash(__('Account Created. Please log in'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(
                    __('The user could not be saved. Please, try again.')
                );
			}


            /*
            //Ideally, I will be able to have a person choose their company name
            // THEN, upon receiving confirmation e-mail, they will get to choose their Refinery, Business Unit, and Plants.



            $businessUnits = $this->User->BusinessUnit->find('list');
            $plants = $this->User->Plant->find('list');
            $this->set(compact('companies', 'businessUnits', 'refineries', 'plants'));
            */
		}
        // For now, we're only going to be asking for the company and refinery id.
        // Later, they will need to enter a valid company e-mail and then a representative at the refinery
        // will validate that they belong.

        $companies = $this->User->Company->find('list');
        $refineries = $this->User->Refinery->find('list');

        $this->set(compact('companies', 'refineries'));

    }

    public function validate_user($company_id = null, $refinery_id = null, $business_unit_id = null) {

        // Work in progress. I initially wanted this for the user to validate which refinery they belong to
        // Now, I'm thinking each site will have a designated user who accepts people who want to join.
        
        $id = $this->Auth->user('id');
        $this->User->id = $id;

        if(!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        if($this->request->is('ajax')){
            $this->autoRender=false;

            if($refinery_id == null) {
                $options = array(
                    'conditions' => array(
                        'Refinery.company_id' => $company_id
                    ),
                    'recursive' => -1
                );
                $refineries = $this->User->Refinery->find('all', $options);
                //$this->set(compact('refineries'));
            }
            echo json_encode($refineries);

        //Update the database if they are goign through the validation steps
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                debug($this->request->data);
                $this->Session->setFlash(__('The user has been updated.'));
                return $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }



        }

        if ($company_id == null) {
            $companies = $this->User->Company->find('list');
            $this->set(compact('companies'));
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

        $this->User->id = $id;

        if(!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        //$user = $this->User->findById($id);

        if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'edit'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}

        // Cake Bake would normally generate these
        // They hae to do with the HABTM relationship

        // Need to set up logic so that the company is automatically chosen based on the email suffix.
        $companies = $this->User->Company->find('list');
        $businessUnits = $this->User->BusinessUnit->find('list');
        $plants = $this->User->Plant->find('list');
        $this->set(compact('companies', 'businessUnits', 'plants'));

    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {

        $this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');

		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect(array("controller" => "users", "action" => "profile"));
                //return $this->redirect($this->Auth->redirectUrl());
                // Prior to 2.3 use
                // `return $this->redirect($this->Auth->redirect());`
            } else {
                $this->Session->setFlash(
                    __('Username or password is incorrect'),
                    'default',
                    array(),
                    'auth'
                );
            }
        }
    } # End Method users/login

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function profile($id = null) {
        /*if(!$this->User->exists()) {
            throw new notFoundException(__('Invalid user'));
        }*/


        // If user is new and still needs to be associated with a refinery, send them to the validation page
        $user = $this->User->findById($this->Auth->user('id'));
        if($this->Auth->user('refinery_id') == 0) {
            $this->redirect(array('action' => 'validate_user'));
        }


        // If a user is new, and has "0" for their company, refinery, and plants, we need to go through a welcome process


        // Handle an ajax request
        if($this->request->is('ajax')) {
            //$variable = 3;

            $businessUnitInfo = $this->User->Plant->BusinessUnit->find('first', array('recursive' =>  0));

            $params = array('conditions' => array('Plant.business_unit_id' =>  $businessUnitInfo['BusinessUnit']['id']));
            $plants = $this->User->Plant->find('list',$params);
            $this->set(compact('plants'));


            $this->request->data = $user;

            //$this->set('content', $variable);
            $this->render('ajax_profile', 'ajax');
        }

        $params = array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            ),

        );
        $this->set('data',$this->User->find('first',$params));

        /*$paramsTOGroups = array(
            'conditions' => array(
                'TurnoverGroup.business_unit_id' => $this->Auth->user('business_unit_id')
            ),
            'recursive' => -1,
        );
        $this->set('refineryInfo',$this->User->Plant->BusinessUnit->Refinery->find('first', array('recursive' =>  0)));
        $this->set('userTOGroups', $this->User->Turnover->TurnoverGroup->find('all', $paramsTOGroups));
        */


    }

    public function plant_edit($id = null) {
        //This function provides user a lists of plants available to them to add/remove from profilef

        if(!$id) {
            throw new NotFoundException(__('Invalid id'));
        }

        // Select the user from the id supplied

        $user = $this->User->findById($id);
        if(!$user) {
            throw new NotFoundException(__('Invalid user'));
        }

        if($this->request->is(array('post','put'))) {
            $this->User->id = $id;

            if($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Plant info has been saved'));
                return $this->redirect(array('action'=>'profile'));
            }
            $this->Session->setFlash(__('Unable to update user'));
        }

        if(!$this->request->data) {

            // Find which business unit the User is a part of and only display those plants

            $businessUnitInfo = $this->User->Plant->BusinessUnit->find('first', array('recursive' =>  0));
            $params = array('conditions' => array('Plant.business_unit_id' =>  $businessUnitInfo['BusinessUnit']['id']));
            $plants = $this->User->Plant->find('list',$params);
            $this->set(compact('plants'));
            $this->request->data = $user;
        }
    }


}
