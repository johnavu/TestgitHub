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
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-theme.min');

        echo $this->Html->css('custom1');
        echo $this->Html->script(array('jquery-1.11.1.min', 'bootstrap', 'jssor', 'jssor.slider.min', 'jquery.cookie', 'isotope.pkgd.min'));

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
                        <a title="John A Vu" href="http://localhost/newblog">
                            <?php echo $this->Html->image('logo.png');?>

                        </a>
                    </div>
                    <div id="left-menu" class="col-sm-4 menu">
                        <ul class="list-inline">
                            <li><a href="http://localhost/newblog">Home</a></li>
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
                <div id="inner-content">
                    <?php if ($this->here == $this->webroot) { ?>
                        <div id="right-content" class="row">

                            <?php echo $this->Session->flash(); ?>

                            <?php echo $this->fetch('content'); ?>
                            <!--                <div id="spinner" style="display: none; float: right;">
                            <?php //echo $this->Html->image('indicator.gif', array('id' => 'busy-indicator'));  ?>
                                            </div>-->
                        </div>
                    <?php } else { ?>
                        <div id="left-content" class="col-sm-8">
                            <?php echo $this->Session->flash(); ?>
                            <?php echo $this->fetch('content'); ?>
                        </div>
                        <div class="col-sm-4 right-sidebar">
                            <?php
                            echo $this->element('search_content');
                            echo $this->element('recent_post');
                            echo $this->element('recent_comment');
                            echo $this->element('tags_list');
                            ?>
                        </div>

                    <?php }
                        ?>

                </div>
            </div>
        </div>
        <div  class="container-fluid footer">
            <div class="inner">
                <div class="container">
                    <div class="fcol col-1 col-sm-4">
                        <?php echo $this->element('categories');?>
                    </div>
                    <div class="fcol col-2 col-sm-4">
                        <?php echo $this->element('search');?>
                    </div>
                    <div class="fcol col-3 col-sm-4">
                        <?php echo $this->element('manager');?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>