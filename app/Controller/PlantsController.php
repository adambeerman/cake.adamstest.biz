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

    public function index() {

    }

    public function profile($id = NULL) {


        $params = array(
            'conditions' => array(
                'Plant.id' => $id,
            )
        );

        $this->set('data', $this->Plant->find('first',$params));

    } # End profile method
}