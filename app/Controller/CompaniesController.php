<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 11:17 AM
 * To change this template use File | Settings | File Templates.
 */

class CompaniesController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');

    public function index() {

        $this->set('companies', $this->Company->find('all'));

    }
}