<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Post extends AppModel
{
    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Title khong duoc de trong'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'required' => true,
                'message' => 'Title da ton tai'
            )
        ),

    );
    public $hasAndBelongsToMany = array(
        'Category' =>
            array(
                'className' => 'Category',
                'joinTable' => 'posts_cats',
                'foreignKey' => 'post_id',
                'associationForeignKey' => 'cat_id',
                'unique' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => 'posts_cats'
            ),
        'Tag' =>
            array(
                'className' => 'Tag',
                'joinTable' => 'posts_tags',
                'foreignKey' => 'post_id',
                'associationForeignKey' => 'tag_id',
                'unique' => true,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => 'posts_tags'
            )
    );
    public $hasMany = array(
        'Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'post_id',
            'conditions' => array('Comment.approved' => 1)
        )
    );
}