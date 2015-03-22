<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TagsController extends AppController {

    public function manager_index() {
        if ($this->request->is('post')) {
            $data = $this->request->data['tags'];

            if (empty($data['id'])) {

                $data += array('create_at' => date('Y-m-d H:i:s'));
            } else {
                $data += array('update_at' => date('Y-m-d H:i:s'));
            }
            if ($this->Tag->save($data)) {
                
                $this->Session->setFlash('Thanh Cong','alert',array('class'=>'success'));
            } else {
                $errors = $this->Tag->validationErrors;
                $message ='';
                foreach ($errors as $error) {
                    foreach ($error as $er) {

                        $message .= $er . ' ';
                    }
                }
               

                $this->Session->setFlash($message,'alert',array('class'=>'error'));
            }
        }
        $this->paginate = array(
            "limit" => "5",
            "order" => array("id" => "DESC"),
        );
        $data = $this->paginate("Tag");

        $this->set('tags', $data);
    }

    public function manager_delete($id) {

        //print_r($this->Category->find('all')); die;
        if ($this->Tag->delete($id)) {
            $this->Session->setFlash(__('The Tag with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'manager_index'));
        }
    }

    public function manager_getTags() {
        $this->autoLayout = false;
        $this->autoRender = false;
        $tags = array();
        $data = $this->Tag->find('list', array('fields' => array('Tag.tag')));
        foreach ($data as $tag) {
            array_push($tags, $tag);
        }

        return json_encode($tags);
    }

    public function getTags() {
        $data = $this->Tag->find('list', array('fields' => array('Tag.tag')));
        return $data;
    }

}
