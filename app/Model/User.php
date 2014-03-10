<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/9/14
 * Time: 9:24 PM
 * To change this template use File | Settings | File Templates.
 */

class User extends AppModel {

    public $hasMany = 'Post';

}