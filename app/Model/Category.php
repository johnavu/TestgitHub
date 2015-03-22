<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Category extends AppModel{
    public $validate = array(
        'title'=>array(
            'notEmpty'=>array(
                'rule'=>'notEmpty',
                'required'=>true,
                'message'=>'Title khong duoc de trong'
            ),
            'isUnique'=>array(
                'rule'=>'isUnique',
                'required'=>true,
                'message'=>'Category da ton tai'
            )
        )
    );
    public $hasAndBelongsToMany = array(
        'Post' =>
            array(
                'className' => 'Post',
                'joinTable' => 'posts_cats',
                'foreignKey' => 'cat_id',
                'associationForeignKey' => 'post_id',
                'unique' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => 'posts_cats'
            )
    );
}