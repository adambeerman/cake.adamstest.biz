<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:55 AM
 * To change this template use File | Settings | File Templates.
 */

class BusinessUnitsController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');


    public function index() {

        // Just grab the basic plant information


        // Want to only grab business units that belong to my refinery
        $params = array(
            'recursive' => -1,
            'conditions' => array(
                'BusinessUnit.refinery_id' => $this->Auth->user('refinery_id')
            )
        );

        $refineryParam = array(
            'conditions' => array(
                'Refinery.company_id' => $this->Auth->user('company_id')
            )
        );

        $this->set('business_units', $this->BusinessUnit->find('all', $params));
        $refineries = $this->BusinessUnit->Refinery->find('list', $refineryParam);
        $this->set(compact('refineries'));

    } # End of method index

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $this->autoRender = false;

        if($this->request->is('post', 'ajax')) {
            $this->BusinessUnit->create();
            if ($this->BusinessUnit->save($this->request->data)) {
                if($this->request->is('ajax')){
                    $this->request->data('BusinessUnit.id', $this->BusinessUnit->id);
                    $this->set('business_unit', $this->request->data);
                    $this->render('success', 'ajax');
                }
                else {
                    $this->Session->setFlash(__('The business unit has been created!'));
                    $this->render('success', 'ajax');
                    //return $this->redirect(array('controller' => 'turnover_groups', 'action' => 'view', $turnover_group_id));
                }
            }
        }
    }# End of Method add

    public function delete($id = NULL) {

        # User not allowed to manually enter a post id to delete
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->BusinessUnit->delete($id)) {
            $this->Session->setFlash(
                __('The business unit with id: %s has been deleted.',h($id))
            );
            return $this->redirect($this->referer());
        }

    } # End function "DELETE"

    public function profile($id = NULL) {
        $params = array(
            'conditions' => array(
                'BusinessUnit.id' => $id,
            ),
        );
        $this->set('data', $this->BusinessUnit->find('first',$params));

    } # End profile method
}