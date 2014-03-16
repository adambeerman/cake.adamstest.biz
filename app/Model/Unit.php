<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 7:26 PM
 * To change this template use File | Settings | File Templates.
 */

class Unit extends AppModel {

    public $belongsTo = array(
        'Plant', 'UnitType');
    public $hasMany = 'Equipment';

}