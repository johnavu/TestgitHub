<?php
$recent_post = $this->requestAction(array('controller' => 'posts', 'action' => 'recent_post'));
?>
<div class="recent-post widget">
    <h3 class="widget-title">Recent Post</h3>
    <ul>
        <?php $i = 1; ?>
        <?php foreach ($recent_post as $rc): ?>
            <li class="<?php
        $i++;
        if ($i % 2 == 0) {
            echo 'even';
        }
            ?>">
                <?php
                    if (empty($rc['Post']['image'])) {
                        echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/df-img.jpg&amp;h=30&amp;w=30', array('url' => array('controller' => 'posts', 'action' => 'view', $rc['Post']['id'])), array('class' => 'img-responsive'));
                    } else {
                        echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $rc['Post']['image'] . '&amp;h=30&amp;w=30', array('url' => array('controller' => 'posts', 'action' => 'view', $rc['Post']['id'])), array('class' => 'img-responsive'));
                    }
                    ?>
                    <?php echo $this->Html->link($rc['Post']['title'], array('controller' => 'posts', 'action' => 'view', $rc['Post']['id'])); ?>

            </li>
        <?php endforeach; ?>

    </ul>   
</div>