<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/10/14
 * Time: 11:58 AM
 * To change this template use File | Settings | File Templates.
 */

class Company extends AppModel {

    public $hasMany = 'Refinery';

    public $displayField = 'name';

}