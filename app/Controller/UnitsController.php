<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 7:23 PM
 * To change this template use File | Settings | File Templates.
 */

class UnitsController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');

    public function index() {

    }

    public function profile($id = NULL) {

        // Logic - only a user with this refinery can see equipment profiles

        $params = array(
            'conditions' => array(
                'Unit.id' => $id,
            )
        );

        $this->set('data', $this->Unit->find('first', $params));

    } # End of method profile
}