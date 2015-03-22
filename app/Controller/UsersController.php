<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class UsersController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        // Controller spesific beforeFilter
    }

    public function manager_dashboard()
    {
        $title_for_layout = 'Dashboard';
        $this->set(compact('title_for_layout'));
    }

    public function manager_login()
    {

        if ($this->request->is('post')) {


            if ($this->Auth->login()) {

                return $this->redirect(array(
                    'controller' => 'posts',
                    'action' => 'index',
                    'manager' => true));
            }
            $this->Session->setFlash(__('WrongUser_Password'));
            $this->redirect(array('controller' => 'users', 'action' => 'manager_login'));
        }
    }

    public function manager_logout()
    {

        if ($this->Auth->logout()) {
            return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
    }

}
