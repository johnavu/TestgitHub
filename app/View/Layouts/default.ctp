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
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('bootstrap.min');
        echo $this->Html->css('bootstrap-theme.min');

        echo $this->Html->css('custom');
        echo $this->Html->script(array('jquery-1.11.1.min', 'bootstrap', 'jssor', 'jssor.slider.min', 'jquery.cookie', 'isotope.pkgd.min'));

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var _SlideshowTransitions = [
                    //Fade
                    {$Duration: 1200, $Opacity: 2}
                ];
                var options = {
                    $AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                    $AutoPlaySteps: 1, //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                    $AutoPlayInterval: 3000, //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                    $PauseOnHover: 1, //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                    $ArrowKeyNavigation: true, //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                    $SlideDuration: 500, //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                    $MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
                    $SlideWidth: 900, //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                    $SlideHeight: 400, //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                    $SlideSpacing: 0, //[Optional] Space between each slide in pixels, default value is 0
                    $DisplayPieces: 1, //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                    $ParkingPosition: 0, //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                    $UISearchMode: 1, //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                    $PlayOrientation: 1, //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                    $DragOrientation: 1, //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                    $SlideshowOptions: {//[Optional] Options to specify and enable slideshow or not
                        $Class: $JssorSlideshowRunner$, //[Required] Class to create instance of slideshow
                        $Transitions: _SlideshowTransitions, //[Required] An array of slideshow transitions to play slideshow
                        $TransitionsOrder: 1, //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                        $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                    },
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$, //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 1, //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,
                        $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                };
                var jssor_slider1 = new $JssorSlider$("slider1_container", options);
                //responsive code begin
                //you can remove responsive code if you don't want the slider scales
                //while window resizes
                function ScaleSlider() {
                    var parentWidth = $('#slider1_container').parent().width();
                    if (parentWidth) {
                        jssor_slider1.$ScaleWidth(parentWidth);
                    }
                    else
                        window.setTimeout(ScaleSlider, 30);
                }
                //Scale slider after document ready
                ScaleSlider();

                //Scale slider while window load/resize/orientationchange.
                $(window).bind("load", ScaleSlider);
                $(window).bind("resize", ScaleSlider);
                $(window).bind("orientationchange", ScaleSlider);
                //responsive code end
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-default " role="navigation" >
            <div class="container-fluid" >
                <div class='row' id="header">
                    <div class="navbar-header"  class="col-md-4">
                        <div class="navbar-brand" id="logo">
                        </div>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>



                    </div>
                    <div  id="navbar"  class="collapse navbar-collapse col-md-8 ">

                        <ul  class="nav navbar-nav" >

                            <li><a href="http://localhost/portfolio" class="active">Home</a></li>

                            <li><a href="#">Portfolio</a></li>
                            <li><a href="#">Support</a></li>

                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <!--                    <div class="col-md-4" id="social">
                                            <ul class="list-inline">
                                                <li><a href=''><?// echo $this->Html->image('rss.png'); ?></a></li>
                                                <li><a href=''><?php //echo $this->Html->image('rss.png');            ?></a></li>
                                                <li><a href=''><?php //echo $this->Html->image('rss.png');            ?></a></li>
                                                <li><a href=''><?php //echo $this->Html->image('rss.png');            ?></a></li>
                                                <li><a href=''><?php //echo $this->Html->image('rss.png');            ?></a></li>
                                            </ul>
                                        </div>-->

                </div>
            </div>
        </nav>
        <?php echo $this->element('slides'); ?>
        <div class="container" id='main'>

            <div id="content" class="row">

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
                <!--                <div id="spinner" style="display: none; float: right;">
                <?php //echo $this->Html->image('indicator.gif', array('id' => 'busy-indicator'));  ?>
                                </div>-->
            </div>
        </div>
        <div class="container sibar" id="sibar" >
            <div  class="row">
                <div class="col-md-4 sibar" id="sibar-1">

                    <div class="row" id='searchbox'>
                        <div class="col-md-9"><input type="text" class="search form-control"/></div>
                        <div class="col-md-2"><input type="button" class="searchbutton btn btn-default" value="Search"/></div>
                    </div>
                </div>
                <div class="col-md-8 sibar" id="sibar-2" >

                    <div class="row">
                        <div class="col-md-4 cat sibar">
                            <h3>Categories</h3>
                            <ul>
                                <li ><i class="fa fa-fighter-jet"></i><a href='' > Jquery</a></li>
                                <li ><i class="fa fa-fighter-jet"></i><a href='' > HTML</a></li>


                            </ul>
                        </div>
                        <div class="tags col-md-8 sibar">
                            <h3>Tags</h3>
                            <span class="s1"><a href="#">jquery</a></span>
                            <span><a href="#">html</a></span>
                            <span><a href="#">css</a></span>
                            <span class="s2"><a href="#">jquery1</a></span>
                            <span><a href="#">html1</a></span>
                            <span class="s3"><a href="#">css1</a></span>
                            <span class="s1"><a href="#">jquery</a></span>
                            <span><a href="#">html</a></span>
                            <span><a href="#">css</a></span>
                            <span class="s2"><a href="#">jquery1</a></span>
                            <span><a href="#">html1</a></span>
                            <span class="s3"><a href="#">css1</a></span>
                            <span class="s1"><a href="#">jquery</a></span>
                            <span><a href="#">html</a></span>
                            <span><a href="#">css</a></span>
                            <span class="s2"><a href="#">jquery1</a></span>
                            <span><a href="#">html1</a></span>
                            <span class="s3"><a href="#">css1</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       


    </body>
</html>
