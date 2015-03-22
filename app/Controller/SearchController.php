<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class SearchController extends AppController
{

    public $uses = null;

    public function beforeFilter()
    {

        parent::beforeFilter();
        $this->Auth->allow();
        $this->loadModel('Post');
    }

    public function index()
    {
        if (isset($this->request->query['tag']) || isset($this->request->query['cat'])) {
            if (isset($this->request->query['tag'])) {
                $tag = $this->request->query['tag'];
                $RTable = 'posts_tags';
                $RCondtion = array('posts_tags.post_id = Post.id');
                $Table = 'tags';
                $conditions = array('tags.id = posts_tags.tag_id', 'tags.tag LIKE' => "%$tag%");
                $search = array('tag', $tag);
            }
            if (isset($this->request->query['cat'])) {
                $cat = $this->request->query['cat'];
                $RTable = 'posts_cats';
                $RCondtion = array('posts_cats.post_id = Post.id');
                $Table = 'categories';
                $conditions = array('categories.id = posts_cats.cat_id', 'categories.title LIKE' =>
                        "%$cat%");
                $search = array('Category', $cat);
            }
            $this->paginate = array('Post' => array('limit' => '10', 'joins' => array(array
                            (
                            'table' => $RTable,
                            'alias' => $RTable,
                            'type' => 'inner',
                            'conditions' => $RCondtion), array(
                            'table' => $Table,
                            'alias' => $Table,
                            'type' => 'inner',
                            'conditions' => $conditions))));
        } else
            if (isset($this->request->query['con'])) {
                $con = $this->request->query['con'];

                $this->paginate = array(
                    'limit' => '10',
                    'order' => array('post.id' => 'DESC'),
                    'conditions' => array('or' => array('post.title LIKE' => "%$con%",
                                'post.content LIKE' => "%$con%")));
                $search = array('Content', $con);
            } else {

                $this->redirect(array('controller' => 'posts', 'action' => "index"));
            }


            $data = $this->paginate('Post');

        $this->set('posts', $data);
        $this->set('search', $search);
        $this->set('title_for_layout',"Search: $search[0] : $search[1]");
    }

}
