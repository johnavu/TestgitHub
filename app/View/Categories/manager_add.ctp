<?php
echo $this->Form->create('categories', array('class' => 'form-inline'));
echo $this->Form->label('category.title','Category Name',array('div'=>false,'class'=>'control-label m-r-5'));
echo $this->Form->input('title', array('class' => 'form-control m-r-5', 'div' => false,'label'=>false));
echo $this->Form->button('Add', array('type' => 'submit', 'div' => false));
echo $this->Form->end();
?>
