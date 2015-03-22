

<div class="row">
    <div class="col-sm-6 "><h3>Posts List</h3></div>
    <div class="col-sm-6 btnAdd">
        <?php
        echo $this->Html->link('Add Post', array('controller' => 'posts', 'action' =>
                'manager_add'),array('class'=>'btn btn-default alignRight'));
        ?>
    </div>
</div>
<table class="table table-responsive table-hover table-striped table-bordered tb-list">
    <tr>
        <th><?php echo $this->Paginator->sort("id", "ID<i class='id fa'></i>",
array('escape' => false)); ?></th>
        <th>IMG</th>
        <th><?php echo $this->Paginator->sort("title",
"Title<i class='title fa'></i>", array('escape' => false)); ?></th>

        <th>Categories</th>
        <th>Tags</th>
        <th><?php echo $this->Paginator->sort("create_at",
"Create<i class='create_at fa'></i>", array('escape' => false)); ?></th>
        <th><?php echo $this->Paginator->sort("update_at",
"Update<i class='update_at fa'></i>", array('escape' => false)); ?></th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['Post']['id']; ?></td>
            <td><?php
    if (empty($post['Post']['image'])) {
        echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
            '/timthumb.php?src=' . FULL_BASE_URL .
            '/newblog/app/webroot/img/upload/df-img.jpg&amp;h=50&amp;w=50');
    } else {
        echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
            '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $post['Post']['image'] .
            '&amp;h=50&amp;w=50');
    }
?></td>
            <td><?php echo $post['Post']['title']; ?></td>

            <td>
                <span data-toggle="tooltip" data-placement="top" data-html='true' title="<?php
    if (empty($post['Category'])) {
        echo " ";
    } else {
        foreach ($post['Category'] as $cat) {
            echo $cat['title'] . "<br/>";
        }
    }
?>">
                          <?php
    if (empty($post['Category'])) {
        echo " ";
    } else {
        echo "<p>" . $post['Category'][0]['title'] . "</p>";
    }
?>
                </span>
            </td>

            <td>
                <span data-toggle="tooltip" data-placement="top" data-html='true' title="<?php
    if (empty($post['Tag'])) {
        echo " ";
    } else {
        foreach ($post['Tag'] as $tag) {
            echo "<p>" . $tag['tag'] . "</p>";
        }
    }
?>">
                          <?php
    if (empty($post['Tag'])) {
        echo " ";
    } else {

        echo $post['Tag'][0]['tag'];
    }
?>
                </span>
            </td>
            <td><?php echo $post['Post']['create_at'] ?></td>
            <td><?php echo $post['Post']['update_at']; ?></td>
            <td><?php echo $this->Html->link('Delete', array(
        'controller' => 'posts',
        'action' => 'manager_delete',
        $post['Post']['id']), array('confirm' => 'Are you OK?','class'=>'btn btn-default')); ?></td>
            <td><?php echo $this->Html->link('Edit', array(
        'controller' => 'posts',
        'action' => 'manager_add',
        $post['Post']['id']),array('class'=>'btn btn-default')); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination-lg">
    <ul class="pagination">
           <?php
echo $this->Paginator->prev('<<', array('tag' => 'li'), null, array(
    'tag' => 'li',
    'class' => 'disabled',
    'disabledTag' => 'a'));
echo $this->Paginator->numbers(array(
    'separator' => '',
    'currentTag' => 'a',
    'currentClass' => 'active',
    'tag' => 'li',
    'first' => 1));
echo $this->Paginator->next('>>', array('tag' => 'li', 'currentClass' =>
        'disabled'), null, array(
    'tag' => 'li',
    'class' => 'disabled',
    'disabledTag' => 'a'));
?>
        </ul>
</div>
<script type="text/javascript">
            var sort = '.id';
            var dir='fa-sort-desc';
            $(sort).addClass(dir);
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
        function getUrlParameter(sParam)
        {
            var sPageURL = window.location.href;
            var sURLVariables = sPageURL.split('/');

            for (var i = 0; i < sURLVariables.length; i++)
            {
                var sParameterName = sURLVariables[i].split(':');
                if (sParameterName[0] == sParam)
                {
                    return sParameterName[1];
                }
            }
        }
        var sort = '.' + getUrlParameter('sort');
        var dir = getUrlParameter('direction');
        if (dir == 'asc') {
            dir = 'fa-sort-asc';
        }
        if (dir == 'desc') {
            dir = 'fa-sort-desc';
        }
        $(sort).addClass(dir);
    });
</script>