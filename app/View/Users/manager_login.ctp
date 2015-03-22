
    <div class='col-sm-5'>
        <?php
        echo $this->Session->flash();
        echo $this->Form->create('User', array('method' => 'post'));
        echo $this->Form->label('Username');
        echo $this->Form->input('username', array('div' => false, 'label' => false, 'class' => 'form-control'));
        echo $this->Form->label('Password');
        echo $this->Form->input('password', array('div' => false, 'label' => false, 'class' => 'form-control'));
        echo $this->Form->end('Login');
        ?>
    </div>
