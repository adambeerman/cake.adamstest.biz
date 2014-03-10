<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/6/14
 * Time: 12:20 PM
 * To change this template use File | Settings | File Templates.
 */

class Post extends AppModel {

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

}