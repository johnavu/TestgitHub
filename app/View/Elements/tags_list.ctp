<?php
$getTags = $this->requestAction(array('controller' => 'tags', 'action' => 'getTags'));

?>
<div class="tags widget">
    <h3 class="widget-title">Tags</h3>
    <div>
        <?php foreach ($getTags as $gtag): ?>
            <span><?php echo $this->Html->link($gtag,array('controller'=>'search','action'=>'index','?'=>array('tag'=>$gtag)));?></span>
        <?php endforeach; ?>

    </div>
</div>
