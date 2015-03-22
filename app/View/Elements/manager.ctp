<h3 class="widget-title">Manager</h3>
<ul>
    <?php if ($this->Session->check('Auth.User')) { ?>
        <li><?php echo $this->Html->link('Manger Site', array('controller' => 'posts', 'action' => 'index', 'manager' => true)); ?></li>
   <li><?php echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout', 'manager' => true)); ?></li>
 <?php } else { ?>
        <li><?php echo $this->Html->link('Login', array('controller' => 'users', 'action' => 'login', 'manager' => true)); ?></li>
    <?php } ?>
</ul>
