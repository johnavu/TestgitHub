<?php
$getTags = $this->requestAction(array(
    'controller' => 'tags',
    'action' => 'getTags',
    'manager' => false));

?>
<?php

if ($this->Session->check('post')) {
    $ses = $this->Session->read('post');

    unset($_SESSION['post']);

} else {
    $ses = array();
}
?>
<?php
if (isset($this->request->data['post'])) {
    $currentTags = $this->request->data['post']['tags'];
}

?>
<h3>Add Posts</h3>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('post', array(
    'type' => 'post',
    'enctype' => 'multipart/form-data',
    'div' => false)); ?>
<div class="row form-post">
    <div class="col-sm-8">
        <div class="form-group">
            <label for="postTitle" class=" control-label">Title</label>

            <div class="">
                <?php echo $this->Form->input('title', array(
                    'div' => false,
                    'label' => false,
                    'type' => 'text',
                    'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <label class=" control-label">Content</label>

            <div class="">
                <?php echo $this->Tinymce->textarea('post.content', array('label' => false,
                    'rows' => 10), null, 'full'); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="">
                <?php echo $this->Form->button('Save', array(
                    'div' => false,
                    'label' => false,
                    'type' => 'submit',
                    'class'=>'btn btn-primary'
                    )); ?>
                <?php echo $this->Form->button('Reset', array(
                    'div' => false,
                    'label' => false,
                    'id' => 'btReset',
                    'type' => 'button',
                    'class'=>'btn btn-primary')); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="postTitle" class=" control-label">Category</label>

            <div class="">
                <?php echo $this->Form->input('category_id', array(
                    'div' => false,
                    'label' => false,
                    'type' => 'select',
                    'multiple' => 'multiple',
                    'class' => 'form-control'), array('options' => $categories)); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="posttag" class=" control-label">Tag</label>

            <div class="">
                <?php echo $this->Form->input('tags', array(
                    'div' => false,
                    'label' => false,
                    'type' => 'text',
                    'class' => 'form-control')); ?>
            </div>
        </div>
        <div>
            <?php echo $this->Form->hidden('Iphidden'); ?>
        </div>
        <div class="form-group">
            <div class="tag-choosed">

            </div>
        </div>
        <div class="form-group">
            <div class="tag-list">
                <?php
                foreach ($getTags as $getTag) {
                    echo "<a href='javascript:void(0)'>" . $getTag . "</a> ";
                }

                ?>
            </div>
        </div>
        <div class="form-group">
            <label class=" control-label">Image</label>

            <div class="">
                <?php echo $this->Form->input('image', array(
                    'div' => false,
                    'label' => false,
                    'type' => 'file')); ?>
            </div>

        </div>
        <div class="img-show">
            <?php
            if (!empty($img)) {
                echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
                    '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $img .
                    '&amp;h=200&amp;w=200');
            }
            ?>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">

    $(document).ready(function () {

        var posttag = '<?php
        if(isset($currentTags)){
        echo $currentTags;
        }

        ?>';

        $('#postTags').val('');
        tagchoose = posttag.split(/,\s*/);
        fillTag(tagchoose);
        $.ajax({
            url: '<?php echo Router::url(array('controller' => 'tags', 'action' =>
    'getTags')); ?>',
            dateType: 'json',
            type: 'post',
            data: {},
            success: function (r) {
                var tags = JSON.parse(r);
                var html = '';
                /*
                 $.each(tags, function (k, v) {
                 html += "<span><a href='#' class='choose-tag'>";
                 html += v;
                 html += "</a></span> ";
                 });
                 $('.tag-list').html(html);
                 */
                function split(val) {
                    return val.split(/,\s*/);
                }

                function extractLast(term) {
                    return split(term).pop();
                }

                $('#postTags').bind("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                        $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                }).autocomplete({
                    source: function (request, response) {
// delegate back to autocomplete, but extract the last term
                        response($.ui.autocomplete.filter(
                            tags, extractLast(request.term)));
                    },
                    focus: function () {
// prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {

                        var terms = split(this.value);
// remove the current input

                        terms.pop();
// add the selected item
                        terms.push(ui.item.value);
// add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(", ");

                        return false;
                    }
                });
            }

        });
        $("#postImage").change(function () {

            $(".img-show").html("");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            if (regex.test($(this).val().toLowerCase())) {


                if (typeof (FileReader) != "undefined") {
                    $(".img-show").show();
                    $(".img-show").append("<img />");
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(".img-show img").attr("src", e.target.result).width(200).height(200);
                    }
                    reader.readAsDataURL($(this)[0].files[0]);
                    console.log($(this)[0].files[0]);
                } else {
                    alert("This browser does not support FileReader.");
                }

            } else {
                alert("Please upload a valid image file.");
                $("#postImage").replaceWith($("#postImage").val('').clone(true));
            }
        });
        //var tagchoose = [];

        $(document).on('click', '.tag-list a', function () {
            tagchoose.push($(this).text());

            fillTag(tagchoose);

            console.log(tagchoose);
        });

        $('#postTags').on('blur', function () {
            var t = $(this).val().split(/,\s*/);
            $.each(t, function (k, v) {
                if (v) {
                    tagchoose.push(v);
                }

            });

            fillTag(tagchoose);
            $(this).val('');

        });
        $(document).on('click', '.tag-wrap', function () {
            var ct = $(this).text();
            tagchoose = $('#postIphidden').val().split(/,\s*/);

            tagchoose = $.grep(tagchoose, function (a) {
                return $.trim(a) != $.trim(ct);
            });
            //console.log(tagchoose);
            fillTag(tagchoose);
        });
        function fillTag(r) {
            var html = '';

            $.each(r, function (k, v) {
                if (v) {
                    html += "<div class='tag-wrap'><a href='javascript:void(0)' class='ctag'><i class='fa fa-times'></i></a> " + v + "</div>";
                }
            });
            $('.tag-choosed').html(html);

            $('#postIphidden').val(r);

        }

        $('#btReset').click(function () {
            var session = '<?php echo json_encode($ses);?>';
            session = JSON.parse(session);
           if(session.length != 0) {
               $('#postTitle').val(session['post']['title']);
               tinyMCE.activeEditor.setContent(session['post']['content']);
               var cat_id = session['post']['category_id'];
               $('#postCategoryId').val(cat_id);
               tagchoose = [];
               tagchoose = session['post']['tags'].split(/,\s*/);
               fillTag(tagchoose);
               $("#postImage").replaceWith($("#postImage").val('').clone(true));




               //$(".img-show").show();
               //$(".img-show").append("<img />");
               var url = '<?php
            if (!empty($img)) {
                echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' .
                    '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $img .
                    '&amp;h=200&amp;w=200');
            }
            ?>';


               $(".img-show").html(url);
           }else{
               $('#postTitle').val('');
               tinyMCE.activeEditor.setContent('');

               $('#postCategoryId').val('');
               tagchoose = [];

               fillTag(tagchoose);
               $("#postImage").replaceWith($("#postImage").val('').clone(true));




               //$(".img-show").show();
               //$(".img-show").append("<img />");
               var url = '';


               $(".img-show").html(url);
           }


        });


    });

</script>