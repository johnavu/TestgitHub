<?php echo $this->Session->flash(); ?>
<h3>Categories</h3>

<div class="row">
    <div class="col-sm-3">
        <h4><a href="javascript:void(0)" class="add-cat" id="add-cat">Add Category</a></h4>
        
        <?php
echo $this->Form->create('categories',array('class'=>'form'));
echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'idhidden'));
?>
<div class="form-group">
<?php
echo $this->Form->input('title', array(
    'class' => 'form-control',
    'div' => false,
    'label' => false,
    'class' => 'iptitle'));
?>
</div>
<div class="form-group">
<?php
 echo $this->Form->button('Add',array('class'=>'btn btn-primary','div'=>false,'label'=>false));
        echo $this->Form->end();
?>
</div>
    </div>
    <div class="col-sm-9">
        <h4>Categories List</h4>
        <table class="table table-responsive table-hover table-striped table-bordered tb-list">
            <tr>
                <th><?php echo $this->Paginator->sort("id",
"ID<i class='id fa'></i>", array('escape' => false)); ?>
                </th>
                <th><?php echo $this->Paginator->sort('title',
"Title<i class='title fa'></i>", array('escape' => false)); ?></th>
                <th><?php echo $this->Paginator->sort('create_at',
"Create<i class='create_at fa'></i>", array('escape' => false)); ?></th>
                <th><?php echo $this->Paginator->sort('update_at',
"Update<i class='update_at fa'></i>", array('escape' => false)); ?></th>
                <th>Total Posts</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['Category']['id']; ?></td>
                    <td><?php echo $category['Category']['title']; ?></td>
                    <td><?php echo $category['Category']['create_at']; ?></td>
                    <td><?php echo $category['Category']['update_at']; ?></td>
                    <td><?php echo count($category['Post']); ?></td>
                    <td><a href='javascript:void(0)' class='edit btn btn-default'>Edit</a></td>
                    <td><?php echo $this->Html->link('Delete', array('action' =>
'manager_delete', $category['Category']['id']), array('confirm' => 'Are you OK?','class'=>'btn btn-default')); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <div class="pagination-lg">
           <ul class="pagination">
           <?php
                echo $this->Paginator->prev('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                echo $this->Paginator->next('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
            $('.idhidden').val('');
            $('.iptitle').val('');
            $('button:submit').text('Add');
            var sort = '.id';
            var dir='fa-sort-desc';
            $(sort).addClass(dir);
    $(document).ready(function () {
        $('.edit').click(function () {
            var id = $(this).closest('tr').find('td:first').text();
            var title = $(this).closest('tr').find('td:nth-child(2)').text();
            $('.idhidden').val(id);
            $('.iptitle').val(title);
            $('button:submit').text('Update');
        });
        $('.add-cat').click(function () {
            $('.idhidden').val('');
            $('.iptitle').val('');
            $('button:submit').text('Add');
        });
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

        sort = '.'+getUrlParameter('sort');
        dir = getUrlParameter('direction');
        if(dir=='asc'){
            dir='fa-sort-asc';
        }
        if(dir=='desc'){
            dir='fa-sort-desc';
        }

        $(sort).addClass(dir);
    });
</script>