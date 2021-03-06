<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/6/14
 * Time: 12:20 PM
 * To change this template use File | Settings | File Templates.
 */

class Post extends AppModel {

    public $belongsTo = 'User';

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
}


}