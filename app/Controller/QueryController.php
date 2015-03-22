<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class QueryController extends AppController {
    public $uses = null;
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
        $this->loadModel('Post');   
    }
    
    public function index(){
        
        die('aaaaaaaaa');
    }
}
