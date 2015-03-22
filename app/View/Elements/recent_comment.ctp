<?php
$recent_comment = $this->requestAction(array('controller' => 'comments', 'action' => 'recent_comment'));
?>
<div class="recent-comment widget">
    <h3 class="widget-title">Recent Comment</h3>
    <ul>
        <?php $i=1;?>
        <?php foreach ($recent_comment as $rcom):?>
        <li class="<?php $i++; if($i%2==0){echo 'even';} ?>">
            <?php echo $this->Html->link($rcom['Comment']['author'],array('controller'=>'posts','action'=>'view',$rcom['Post']['id'])); ?>
            {Post:<?php echo $this->Html->link($rcom['Post']['title'],array('controller'=>'posts','action'=>'view',$rcom['Post']['id']));?>}
            <div >
             <?php echo $this->Html->link($rcom['Comment']['comment'],array('controller'=>'posts','action'=>'view',$rcom['Post']['id'])) ?>
            </div>
        </li>
        <?php endforeach;?>
        
    </ul>   
</div>