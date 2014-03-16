<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:41 AM
 * To change this template use File | Settings | File Templates.
 */

class Plant extends AppModel {

    var $name = 'Plant';
    var $displayField = 'short_name';

    public $hasMany = array('Equipment','Unit');
    public $belongsTo = 'BusinessUnit';

    public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'plants_users',
                'foreignKey' => 'plant_id',
                'associationForeignKey' => 'user_id',
                'unique' => true
            )
    );


}