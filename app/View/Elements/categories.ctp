<?php 
$get_cats=$this->requestAction(array('controller'=>'categories','action'=>'getCat'));

?>
<h3 class="widget-title">Categories</h3>
<ul>
    <?php foreach($get_cats as $gc):?>
    <li><?php echo $this->Html->link($gc,array('controller'=>'search','action'=>'index','?'=>array('cat'=>$gc)));?></li>
    <?php endforeach;?>
</ul>
    
    
