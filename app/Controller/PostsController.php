<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/6/14
 * Time: 12:28 PM
 * To change this template use File | Settings | File Templates.
 */

class PostsController extends AppController {
    public $helpers = array('Html', 'Form');
    var $scaffold = 'admin';
    
    public function index() {
        $this->set('posts', $this->Post->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__("Invalid post"));
        }

        $post = $this->Post->findById($id);

        if (!$post) {
            throw new NotFoundException(__("Invalid post"));
        }
        $this->set('post', $post);
    }

    public function add(){

        if ($this->request->is('post')){
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'));
                return $this->redirect(array('action'=>'index'));
            }
            $this->Session->setFlash(__('Unable to add your post'));
        }
    }

    public function edit($id = NULL) {

        # Verify that an id was passed
        if(!$id) {
            throw new NotFoundException(__('Invalid Post'));
        }

        $post = $this->Post->findById($id);

        # Verify the id corresponds to a particular post
        if(!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->SetFlash(__('Your post has been updated'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));

        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }



    }

    public function delete($id = NULL) {

        # User not allowed to manually enter a post id to delete
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(
                __('The post with id: %s has been deleted.',h($id))
            );
            return $this->redirect(array('action' => 'index'));
        }

    } # End function "DELETE"

}