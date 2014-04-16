<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:57 AM
 * To change this template use File | Settings | File Templates.
 */

class BusinessUnit extends AppModel {

    var $name = 'BusinessUnit';
    var $displayField = 'short_name';

    public $hasMany = array(
        'Plant' => array(
            'className' => 'Plant',
            'foreignKey' => 'business_unit_id'
        ),
        'TurnoverGroup');


    public $belongsTo = array(
        'Refinery' => array(
            'className' => 'Refinery',
            'foreignKey' => 'refinery_id'
        )
    );

}