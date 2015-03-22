<?php

/*
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

class CommentsController extends AppController
{

    public function add()
    {
        $this->autoLayout = false;
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $data['approved'] = 0;
            $data['create_at'] = date('Y-m-d H:i:s');
            if ($this->Comment->save($data)) {
                $m = "Ban da dang comment thanh cong, comment cua ban se duoc hien thi khi admin kiem duyet";
            } else {
                $m = "Dang Comment that bai";
            }
            return json_encode($m);
        }
    }

    public function manager_index()
    {
        $this->paginate = array(
            "limit" => "5",
            "order" => array("id" => "ASC"),

        );
        $data = $this->paginate("Comment");
        $this->set('comments', $data);
    }

    public function manager_appoved()
    {
        $this->autoLayout = false;
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $comment_id = $this->request->data;
            $data = $this->Comment->findByid($comment_id);

            $data['Comment']['approved'] = ($data['Comment']['approved'] == 1) ? 0 : 1;

            $m['id'] = $comment_id['comment_id'];
            $m['approved'] = $data['Comment']['approved'];
            if ($this->Comment->save($data)) {
                $m['result'] = 1;
            } else {
                $m['result'] = 0;
            }
        }
        return json_encode($m);
    }

    public function manager_delete($id)
    {

        //print_r($this->Category->find('all')); die;
        if ($this->Comment->delete($id)) {
            $this->Session->setFlash(__('The Comment has been deleted.', h($id)));
            return $this->redirect(array('action' => 'manager_index'));

        }
    }

    public function recent_comment()
    {
        $data = $this->Comment->find('all', array(
            'limit' => '5',
            'fields' => array(
                'Comment.author',
                'Comment.comment',
                'Post.id',
                'Post.title'),
            'order' => array('Comment.id' => 'desc'),
            'conditions' => array('Comment.approved' => '1')));
        return $data;
    }

}
