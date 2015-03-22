<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User extends AppModel
{
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Username khong de trong'
            ),
            'Unique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Username phai la duy nhat'
            ),
            'leng 8-16'=>array(
                'rule'=>array('lengthBetween', 8, 16),
                'required'=>true,
                'message'=>'Username tu 8 den 16 ki tu'
            )
        ),
        'password'=>array(
            'rule'=>array('lengthBetween', 8, 16),
            'message'=>'Password tu 8 den 16 ki tu'
        )
    );

    public function beforeSave($options = array())
    {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}