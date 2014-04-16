<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:54 AM
 * To change this template use File | Settings | File Templates.
 */

class PlantsController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');
    public $components = array('RequestHandler');

    public function index() {

        // Just grab the basic plant information
        $params = array(
            'recursive' => -1
        );

        $this->set('plants', $this->Plant->find('all', $params));
        $businessUnits = $this->Plant->BusinessUnit->find('list');
        $this->set(compact('businessUnits'));

    } # End of method index

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        $this->autoRender = false;

        if($this->request->is('post', 'ajax')) {

            $this->Plant->create();

            if ($this->Plant->save($this->request->data)) {
                if($this->request->is('ajax')){

                    $this->request->data('Plant.id', $this->Plant->id);
                    $this->set('plant', $this->request->data);
                    $this->render('success', 'ajax');
                }
                else {
                    $this->Session->setFlash(__('The turnover has been saved.'));
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

        if ($this->Plant->delete($id)) {
            $this->Session->setFlash(
                __('The plant with id: %s has been deleted.',h($id))
            );
            return $this->redirect($this->referer());
        }

    } # End function "DELETE"

    public function profile($id = NULL) {


        $params = array(
            'conditions' => array(
                'Plant.id' => $id,
            ),
        );

        $this->set('data', $this->Plant->find('first',$params));


        $params2 = array(
            'conditions' => array(

            )
        );
        $this->loadModel('UnitType');
        $this->set('units', $this->UnitType->find('first'));


    } # End profile method

}