<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>

            <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-theme.min');
        echo $this->Html->css('jquery-ui.min');
        echo $this->Html->css('font-awesome.min');
        echo $this->Html->css('custom1');
        echo $this->Html->script(array(
            'jquery-1.11.1.min',
            'bootstrap',
            'jquery.cookie',
            'jssor.slider.min',
            'isotope.pkgd.min',
            'jquery-ui'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>

    </head>
    <body>
        <div id="header" class="container-fluid">
            <div  class="container">
                <div class="row" id="top-menu">
                    <div id="logo" class="col-sm-4">
                        <a title="John A Vu" href="<?php echo FULL_BASE_URL; ?>/newblog">
                            <?php echo $this->Html->image('logo.png'); ?>

                        </a>
                    </div>
                    <div id="left-menu" class="col-sm-8 menu">
                        <ul class="list-inline">
                            <li><a href="<?php echo FULL_BASE_URL; ?>/newblog">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>

                </div>
                <div class="row" id="header-title-blog">
                    <div class="col-sm-7" id="header-title"><strong>Welcome to Blog of John A Vu</strong></div>
                    <div class="col-sm-5" id="header-social"></div>
                </div>
            </div>
        </div>
        <div id="content-wrap" class="container">
            <div id="outer-content">

                <?php if ($this->Session->check('Auth.User')) { ?>
                    <div class="cat-menu">
                        <div class="innerCat"></div>
                        <div class="labelmenu">
                            <?php echo $this->Html->image('setting-icon.png') ?>
                        </div>
                        <div class="cat-manager">


                            <ul class="nav nav-pills nav-stacked " id="menu-1">

                                <li id="categories"><a href="<?php echo FULL_BASE_URL; ?>/newblog/manager/categories"><i class="fa fa-location-arrow"></i> Categories</a></li>
                                <li id="tags"><a href="<?php echo FULL_BASE_URL; ?>/newblog/manager/tags"><i class="fa fa-tags"></i> Tags</a></li>
                                <li id="posts"><a href="<?php echo FULL_BASE_URL; ?>/newblog/manager/posts"><i class="fa fa-file"></i> Posts</a></li>
                                <li id="comments"><a href="<?php echo FULL_BASE_URL; ?>/newblog/manager/comments"><i class="fa fa-comments"></i> Comments</a></li>
                                <li><?php
                                    echo $this->Html->link('Logout', array('controller' => 'users',
                                        'action' => 'manager_logout'));
                                    ?></li>
                            </ul>

                        </div>
                    </div>
                <?php } ?>
                <div id="inner-content">
                    <div class="manager">


                        <div id="right-content" class="">



                            <?php echo $this->fetch('content'); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="container-fluid footer footer-manager">
            <div class="inner">
                <div class="container">
                    <div class="fcol col-1 col-sm-4">
                        <h3>Information</h3>
                        Copywriter @ 12 - 2014<br />
                        Author:John A Vu. <br />
                    </div>
                    <div class="fcol col-2 col-sm-4">


                    </div>
                    <div class="fcol col-3 col-sm-4">

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<script type="text/javascript">

    $(document).ready(function () {
        var fun = '#' + '<?php echo $this->params['controller']; ?>';
        $(fun).addClass('active');



    });
</script>
