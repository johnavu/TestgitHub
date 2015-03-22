<h3><?php echo $search['0']; ?>: <?php echo $search['1'] ?></h3>
<?php
if (empty($posts)) {
    echo "Noi Dung tim kiem khong ton tai";
} else {
?>
<?php foreach ($posts as $post): ?>
    <?php
        $datetime = $post['Post']['create_at'];
        $daymonth = date('d/m', strtotime($datetime));
        $year = date('Y', strtotime($datetime));
?>
    <div class="post">
        <div class="rb-post">
            <span><?php echo $year; ?></span>
            <p><?php echo $daymonth; ?></p>

        </div>
        <div class="title"><h3><?php echo $this->Html->link($post['Post']['title'],
array(
            'controller' => 'posts',
            'action' => 'view',
            $post['Post']['id'])); ?></h3></div>
        <div class="image-post">
            <?php
        if (empty($post['Post']['image'])) {
            echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
                '/timthumb.php?src=' . FULL_BASE_URL .
                '/newblog/app/webroot/img/upload/df-img.jpg&amp;h=300&amp;w=600', array('class' =>
                    'img-responsive'));
        } else {
            echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
                '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $post['Post']['image'] .
                '&amp;h=300&amp;w=600', array('class' => 'img-responsive'));
        }
?>
        </div>
        <div class="info-post">
            <span>Posted by</span><span><a href="#">John</a></span>
            <span>Category</span><span> <?php
        foreach ($post['Category'] as $cat) {
            echo $this->Html->link($cat['title'], array(
                'controller' => 'search',
                'action' => 'index',
                '?' => array('cat' => $cat['title'])));
        }
?></span>
        </div>
        <div class="content">

            <?php echo $post['Post']['excerp']; ?>
        </div>
        <div class="tags-post">
            <span>Tags:</span><span><?php
        foreach ($post['Tag'] as $tag) {
            echo $this->Html->link($tag['tag'], array(
                'controller' => 'search',
                'action' => 'index',
                '?' => array('tag' => $tag['tag'])));
        }
?></span>
        </div>
        <div class="end-post">
            <div class="alignLeft"><?php
        echo $this->Html->link('Continue Reading >', array(
            'controller' => 'posts',
            'action' => 'view',
            $post['Post']['id']));
?> </div>
            <div class="alignRight"> <?php
        echo $this->Html->link(count($post['Comment']) . ' Comments', array(
            'controller' => 'posts',
            'action' => 'view',
            $post['Post']['id']));
?></div>
        </div>
    </div>
<?php endforeach; ?>
        <div class="paginator" id="paginator-1">
            <?php
    echo $this->Paginator->prev('«  ', null, null, array('class' => 'disabled')); //Shows the next and previous links
    echo "  ";
    if ($this->Paginator->numbers() == '0') {
        echo '1';
    } else {
        echo $this->Paginator->numbers();
    }
    echo "  "; //Shows the page numbers
    echo $this->Paginator->next(' »', null, null, array('class' => 'disabled')); //Shows the next and previous links
    echo "<br/>";
    //            echo $this->Paginator->counter(
    //                    __('Tổng {:count} : từ {:start} đến {:end}')
    //            );

?>
        </div>
<?php } ?>