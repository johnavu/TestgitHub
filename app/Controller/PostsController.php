<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class PostsController extends AppController
{

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('Category');
        $this->loadModel('Tag');
    }

    public function index()
    {
        //
        //        $this->paginate = array(
        //            'limit' => '9',
        //            'order' => array('id' => 'ASC'),
        //
        //        );
        $this->set('title_for_layout','Trang Chu');
        $categories = $this->Category->find('all', array('fields' => 'Category.title'));
        $this->set('Categories', $categories);

        //        $posts = $this->paginate();
        //        $this->set('Posts', $posts);
        //// Also set the AJAX layout if needed
        //        if ($this->request->is('ajax')) {
        //            $this->render('index', 'ajax'); // View, Layout
        //        }
        $posts = $this->Post->find('all', array('order' => array('id' => 'DESC')));

        $this->set('Posts', $posts);
    }

    public function slides()
    {
        if ($this->request->params['requested']) {
            $data = $this->Post->find('all', array('limit' => '5', 'order' => array('id' =>
                        'DESC')));
            return $data;
        } else {
            return 'aaaaa';
        }
    }

    public function view($id)
    {
        if (!$id) {
            return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
        $data = $this->Post->findById($id);

        $this->set('title_for_layout',$data['Post']['title']);
        $this->set('post', $data);
    }

    public function manager_index()
    {
        $this->paginate = array(
            'limit' => '10',
            'order' => array('id' => 'DESC'),
            );
        $posts = $this->paginate("Post");
        $this->set('posts', $posts);
    }

    public function manager_delete($id)
    {
        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('The Post with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'manager_index'));
        }
    }

    public function manager_add($id = null)
    {
        $cat = $this->Category->find('list', array('fields' => array('id', 'title'),
                'recursive' => -1));
        $this->set('categories', $cat);
        if (isset($id)) {
            $post = $this->Post->findById($id);
            $this->set('img', $post['Post']['image']);
            if (!$this->request->data) {
                $this->request->data['post'] = $post['Post'];
                $c = array();
                foreach ($post['Category'] as $cat) {
                    $c[] = $cat['id'];
                }
                $t = '';
                foreach ($post['Tag'] as $t1) {
                    $t .= $t1['tag'] . ", ";
                }
                $this->request->data['post']['tags'] = $t;
                $this->request->data['post']['category_id'] = $c;
                $this->Session->write('post',$this->request->data);
            }
        }


        if ($this->request->is('post')) {

            $data = $this->request->data['post'];

            $data['tags'] = trim($data['Iphidden']);

            $tags_list = array_filter(explode(',', $data['tags']));
            $tags_list = array_map('trim', $tags_list);

            foreach ($tags_list as $tags) {

                $t = $this->Tag->find('count', array('conditions' => array('tag' => $tags)));
                print_r($t);
                if ($t == 0) {
                    print_r($tags);
                    $tag['create_at'] = date('Y-m-d H:i:s');
                    $tag['tag']=$tags;
                    if($this->Tag->save($tag)){

                        echo 'ok';
                    }else {

                        echo 'not ok';
                    }
                }
            }

            $tag = $this->Tag->find('list', array(
                'conditions' => array('tag' => $tags_list),
                'recursive' => -1,
                'fields' => array('id', 'tag')));


            $d['Post'] = array(
                'title' => $data['title'],
                'excerp' => substr($data['content'], 0, 255),
                'content' => $data['content'],

                );
            $d['Category'] = $data['category_id'];

            $d['Tag'] = array_keys($tag);
            if (isset($id) && empty($data['image']['name'])) {

                $d['Post']['image'] = $post['Post']['image'];
            }
            if (!empty($data['image']['name'])) {
                $d['Post']['image'] = time() . $data['image']['name'];
            }
            if (isset($id)) {
                $d['Post']['id'] = $id;
                $d['Post']['update_at'] = date('Y-m-d H:i:s');
            } else {
                $d['Post']['create_at'] = date('Y-m-d H:i:s');
            }
//print_r($d);die;
            if ($this->Post->saveAll($d)) {
                if (isset($id)) {
                    $post = $this->Post->findById($id);
                    $this->set('img', $post['Post']['image']);
                }
                if (!empty($data['image']['tmp_name'])) {
                    if (move_uploaded_file($data['image']['tmp_name'], WWW_ROOT . 'img/upload/' . $d['Post']['image'])) {
                        $message = '<p class="bg-success">Thanh Cong</p>';
                    } else {
                        $message = '<p class="bg-danger">Up Anh Thai Bai</p>';
                    }
                }
                $this->redirect(array('controller' => 'posts', 'action' => 'manager_index'));
            } else {
                $errors = $this->Post->validationErrors;
                $message = '<p class="bg-danger">';
                foreach ($errors as $error) {
                    foreach ($error as $er) {

                        $message .= $er . '<br/>';
                    }
                }
                $message .='</p>';
            }
            $this->Session->setFlash($message);
        }
    }

    public function recent_post()
    {
        $data = $this->Post->find('all', array(
            'limit' => '5',
            'fields' => array(
                'id',
                'title',
                'image'),
            'recursive' => -1,
            'order' => array('id' => 'desc')));
        return $data;
    }

}
