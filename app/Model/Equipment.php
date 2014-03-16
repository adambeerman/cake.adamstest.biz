<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 10:40 AM
 * To change this template use File | Settings | File Templates.
 */

class Equipment extends AppModel {

    public $belongsTo = array('Plant','Unit');

}