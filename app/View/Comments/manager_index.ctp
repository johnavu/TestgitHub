<h3>Comment List</h3>
<table class="table table-responsive table-hover table-striped table-bordered tb-list">
    <tr>
        <th><?php echo $this->Paginator->sort("id",
"ID<i class='id fa'></i>", array('escape' => false)); ?>
                </th>
        <th><?php echo $this->Paginator->sort("author",
"Author<i class='author fa'></i>", array('escape' => false)); ?>
                </th>
        <th><?php echo $this->Paginator->sort("email",
"Email<i class='email fa'></i>", array('escape' => false)); ?>
                </th>
        <th>Post</th>
        <th><?php echo $this->Paginator->sort("comment",
"Comment<i class='comment fa'></i>", array('escape' => false)); ?>
                </th>
        <th><?php echo $this->Paginator->sort("approved",
"Status<i class='approved fa'></i>", array('escape' => false)); ?>
                </th>
        <th><?php echo $this->Paginator->sort("create_at",
"Create<i class='create_at fa'></i>", array('escape' => false)); ?>
                </th>

        <th>Change</th>
        <th></th>
    </tr>
    <?php foreach ($comments as $comment): ?>
        <tr>
            <td><?php echo $comment['Comment']['id']; ?></td>
            <td><?php echo $comment['Comment']['author']; ?></td>
            <td>
                <span data-toggle="tooltip" data-placement="top" title="<?php echo $comment['Comment']['email'];?>">
                <?php
                $email = $comment['Comment']['email'];
                if (strlen($email) > 10) {
                    $email = substr($email, 0, 10) . "...";
                }

                echo $email;
                ?>
                </span>
            </td>
            <td><?php echo $comment['Post']['title']; ?></td>
            <td><?php echo $comment['Comment']['comment']; ?></td>
            <td class="app-com" data-id="<?php echo $comment['Comment']['id'] ?>">
                <?php
                if ($comment['Comment']['approved'] == 0) {
                    echo "<i class='fa fa-times'></i>";
                } else {
                    echo "<i class='fa fa-check-circle'></i>";
                }
                ?>
            </td>
            <td><?php echo $comment['Comment']['create_at']; ?></td>

            <td>
                <?php
                echo "<button class='btn btn-default approve'>OK</button>";
                ?></td>
            <td><?php echo $this->Html->link('Delete', array('controller' => 'comments', 'action' => 'delete', $comment['Comment']['id']), array('conform' => "Are You OK?",'class'=>'btn btn-default')); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination-lg">
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
//            echo $this->Paginator->counter(
//                    __('Tổng {:count} : từ {:start} đến {:end}')
//            );
    ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
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
        var sort = '.'+getUrlParameter('sort');
        var dir = getUrlParameter('direction');
        if(dir=='asc'){
            dir='fa-sort-asc';
        }
        if(dir=='desc'){
            dir='fa-sort-desc';
        }
        $(sort).addClass(dir);
        $('[data-toggle="tooltip"]').tooltip()
        $('.approve').click(function () {
            var comment_id = $(this).closest('tr').find('td:first').text();
            $.ajax({
                url: '<?php echo Router::url(array('controller' => 'comments', 'action' => 'manager_appoved')); ?>',
                dataType: 'json',
                type: 'post',
                data: {comment_id: comment_id},
                success: function (r) {
                    var cid = r['id'];
                    var a = 'td[data-id=' + cid + ']';
                    var html = "";
                    if (r['result'] == 1) {
                        if (r['approved'] == 1) {
                            html = "<i class='fa fa-check-circle'></i>";
                        } else {
                            html = "<i class='fa fa-times'></i>";
                        }
                        $(a).remove('i').html(html);
                    }

                }
            });
        });
    });
</script>