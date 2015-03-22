
<?php echo $this->element('slides'); ?>
<div class="category" id="category">
    <ul class="list-inline">
        <li><a data-cat="posts" class ='choose' data-total="<?php echo count($Posts) ?>" >ALL</a></li>
        <?php foreach ($Categories as $category): ?>
            <li><span>/</span><a  data-cat="<?php echo $category['Category']['title']; ?>" > <?php echo $category['Category']['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="outerPaginator">
    <div class="paginator" id="paginator">
        <?php //echo $this->element('paginator'); ?>
    </div>
</div>
<div id="post-content" class="grid">
    <?php foreach ($Posts as $post): ?>

        <div class="posts <?php
        foreach ($post['Category'] as $cat) {
            echo str_replace(" ","",$cat['title'])." ";
        }
        ?>">
            <figure class="effect-zoe">
                <?php
                if (empty($post['Post']['image'])) {
                    echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/df-img.jpg&amp;h=300&amp;w=300', array('class' => 'img-thumbnail'));
                } else {
                    echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $post['Post']['image'] . '&amp;h=300&amp;w=300', array('class' => 'img-thumbnail'));
                }
                ?>
                <figcaption>
                    <h3>
                        <?php echo $this->Html->link($post['Post']['title'],array('controller'=>'posts','action'=>'view',$post['Post']['id']));?>
                       </h3>
                    <span class="description"><?php echo $post['Post']['excerp'] ?></span>


                </figcaption>
            </figure>
        </div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    var number = 6;
    var $container = $('#post-content');
    var active = 1;
    $(document).ready(function () {

        var total = $('.category ul li a').data('total');
        //var number = 4;
        var numberpage = parseInt(total / number) + 1;
        $.cookie('total', total);
        $.cookie('page', active);
        $.cookie('cat', 'posts');
        var html = crePagi(active, numberpage);
        // KHoi tao Paginator
        $('.paginator').html(html);



        //Khoi tao ISOTOPE
        //var $container = $('#post-content');
        $container.isotope({
            // main isotope options
            itemSelector: '.posts',
            layoutMode: 'masonry',
            // options for masonry layout mode
            masonry: {
                columnWidth: 300,
                gutter: 20,
                isFitWidth: true
            }
        });
        var category = 'posts';

        beginPaginator(category, total, active);
        //Su kien click Paginator
        $(document).on('click', '.paginator a', function () {
            $('.paginator a.current').removeClass('active');
            //$(this).addClass('active');
            active = $(this).data('page');
            category = $.cookie('cat');
            total = $.cookie('total');
            if ($.isNumeric(active)) {
                $.cookie('page', active);
            }
            beginPaginator(category, total, active);
            return false;
        });
//Khoi tao Paginator
        function beginPaginator(category, total, active) {

            var numberpage = parseInt(total / number) + 1;
            var html = crePagi(active, numberpage);
            $('.paginator').empty().html(html);
            var cat = '.' + category;
            $(cat).each(function (k, v) {

                var pagenumber = parseInt((k) / number) + 1;
                var page = category + '-' + pagenumber;
                $(this).addClass(page);
            });
            active = $('.paginator a.current').data('page');
            var fileterpage = '.' + category + '-' + active;

            $container.isotope({filter: fileterpage});
        }
        // Su kien chon Category
        $('.category ul li > a').on('click', function () {
            $.cookie('page', 1);
            active = 1;
            $(this).removeClass('page-*');
            $('.category ul li').find('a.choose').removeClass('choose');
            $(this).addClass('choose');

            var category = $(this).data('cat').replace(" ", "");

            var cat = '.' + $(this).data('cat').replace(" ", "");

            var total = $(cat).length;
            console.log(total);
            $.cookie('cat', category);
            $.cookie('total', total);
            beginPaginator(category, total, active);




        });
        // Ham tao Paginator
        function crePagi(active, number) {
            var html = '';
            if (active == 'older') {
                active = parseInt($.cookie('page')) - 1;

                if (active < 1) {
                    active = 1;
                }
                $.cookie('page', active);
            }
            if (active == 'newer') {
                active = parseInt($.cookie('page')) + 1;

                if (active > number) {
                    active = number;
                }
                $.cookie('page', active);
            }
            var f_active = active - 1;
            var l_active = active + 1;
            html += '<a href="#" class="prev page-numbers" data-page="older"><</a>';
            if (f_active >= 1) {
                html += '<a href="#" class="page-numbers" data-page="1">1</a>';
                if (f_active > 1) {
                    if (f_active > 2) {
                        html += '<span class="page-numbers dots">…</span>';
                    }
                    html += '<a href="#" class="page-numbers" data-page="' + f_active + '">' + f_active + '</a>';
                }
            }
            html += '<a href="#" class="current" data-page="' + active + '">' + active + '</a>';
            if (l_active <= number) {
                if (l_active < number) {
                    html += '<a href="#" class="page-numbers" data-page="' + l_active + '">' + l_active + '</a>';
                    if (l_active < number - 1) {
                        html += '<span class="page-numbers dots">…</span>';
                    }
                }
                html += '<a href="#"  class="page-numbers" data-page="' + number + '">' + number + '</a>';
            }
            html += '<a href="#" class="next page-numbers" data-page="newer">></a>';
            return html;
        }
    });
</script>

