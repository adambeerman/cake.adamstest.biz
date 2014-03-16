<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:54 AM
 * To change this template use File | Settings | File Templates.
 */

class EquipmentController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');

    public function index() {

    }

    public function map($id = NULL) {

        # If no ID is selected, these are the options
        if(!$id) {

        }

        # Now, find the appropriate equipment
        $equipment = $this->Equipment->findById($id);


        # Need a table that maps before and before and after

    }
}