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

    public function index() {
        $this->set('business_units', $this->BusinessUnit->find('all'));

    }
}