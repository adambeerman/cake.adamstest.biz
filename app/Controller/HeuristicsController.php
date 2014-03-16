<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 5:34 PM
 * To change this template use File | Settings | File Templates.
 */

class HeuristicsController extends AppController {

    var $scaffold = 'admin';
    public $helpers = array('Html', 'Form');

    public function index() {

        $this->set('heuristics', $this->Heuristic->find('all'));
    }
}