<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CategoriesController extends AppController {

    public function manager_index() {
        if ($this->request->is('post')) {
            $data = $this->request->data['categories'];

            if (empty($data['id'])) {

                $data += array('create_at' => date('Y-m-d H:i:s'));
            } else {
                $data += array('update_at' => date('Y-m-d H:i:s'));
            }
            if ($this->Category->save($data)) {

                $this->Session->setFlash('Thanh Cong', 'alert', array('class' => 'success'));
            } else {
                $errors = $this->Category->validationErrors;
                $message = '';
                foreach ($errors as $error) {
                    foreach ($error as $er) {

                        $message .= $er . ' ';
                    }
                }


                $this->Session->setFlash($message, 'alert', array('class' => 'error'));
            }
        }
        $this->paginate = array(
            "limit" => "5",
            "order" => array("id" => "DESC"),
        );
        $data = $this->paginate("Category");


        $this->set('categories', $data);
    }

    public function manager_delete($id) {

        //print_r($this->Category->find('all')); die;
        if ($this->Category->delete($id)) {

            $this->Session->setFlash($message, 'alert', array('class' => 'success'));
            return $this->redirect(array('action' => 'manager_index'));
        }
    }

    public function getCat() {
        $data = $this->Category->find('list', array('fields' => array('Category.title')));

        return $data;
    }

}
