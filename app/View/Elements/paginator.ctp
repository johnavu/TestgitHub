<?php

echo $this->Paginator->prev('«  ', null, null, array('class' => 'disabled')); //Shows the next and previous links
echo "  ";
if ($this->Paginator->numbers() == '0') {
    echo $this->Html->link('1', array('action' => 'index'));
} else {
    echo $this->Paginator->numbers();
}
echo "  "; //Shows the page numbers
echo $this->Paginator->next(' »', null, null, array('class' => 'disabled')); //Shows the next and previous links
echo "<br/>";
echo $this->Paginator->counter(
        __('Tổng {:count} : từ {:start} đến {:end}')
);
?> 