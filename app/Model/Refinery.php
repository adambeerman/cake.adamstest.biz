<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */

class Refinery extends AppModel {

    public $belongsTo = 'Company';
    public $hasMany = array('BusinessUnit','TurnoverGroup','User');

}