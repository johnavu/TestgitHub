
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
    <div class="title"><h3><a href=""><?php echo $post['Post']['title'] ?></a></h3></div>
    <div class="image-post">
<!--            <img src="upload/n1.jpg" class="img-responsive" alt=""  />-->
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
        <span>Category</span><span>
            <?php
foreach ($post['Category'] as $cat) {
    echo $this->Html->link($cat['title'], array(
        'controller' => 'search',
        'action' => 'index',
        '?' => array('cat' => $cat['title'])));
}
?>
        </span>
    </div>
    <div class="except-content">
        <?php echo $post['Post']['content']; ?>

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
    <div class="comment-list" id="comment-show">
        <h3>Comment (<?php echo count($post['Comment']); ?>)</h3>
        <a class="link-addcomment alignRight" href="#respond">Add a comment</a>
        <ol>
            <?php foreach ($post['Comment'] as $com): ?>
                <li>
                    <div class="comment-box">
                        <div class="comment-author"><?php echo $com['author'] ?></div>
                        <div class="comment-date"><?php echo date('d/m/Y',
strtotime($com['create_at'])); ?></div>
                        <div class="comment-text"><?php echo $com['comment']; ?></div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
        <div id="respond">
            <h3 id="reply-title" class="comment-reply-title">Add a comment </h3>
            <div id="results"></div>
            <form action="#" method="post" id="addcomments" class="comment-form">
                <div class="row">
                    <div class="col-sm-6 alignLeft ">
                        <label for="author">Your name (optional)</label>
                        <input name="author" class="inputtext  required form-control" id="author" value="" tabindex="1" aria-required="true" type="text">
                    </div>
                    <div class="col-sm-6 alignLeft">
                        <label for="email">Your email (required)</label>
                        <input name="email" class="inputtext  required form-control" id="email" value="" tabindex="2" aria-required="true" type="text">
                    </div>
                </div>
                <div class="row">
                    <label>Your message</label>
                    <textarea name="comment" class="textarea  required form-control" id="comment" rows="10" cols="30" tabindex="4" aria-required="true"></textarea>
                </div>
                <div class="row">
                    <p class="form-submit">
                        <input name="submit" id="submit" value="Submit Comment" type="button" />

                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#submit').click(function () {
            var author = $('#author').val();
            var email = $('#email').val();
            var comment = $('#comment').val();
            var post_id = <?php echo $post['Post']['id']; ?>;
            $.ajax({
                url: '<?php echo Router::url(array('controller' => 'comments',
'action' => 'add')); ?>',
                dataType: 'json',
                type: 'post',
                data: {author: author, email: email, comment: comment, post_id: post_id},
                success: function (r) {

                    $('#results').html(r);
                }
            });
        });
        ;
    });
</script>