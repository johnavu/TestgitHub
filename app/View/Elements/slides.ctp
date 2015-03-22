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
                    $SlideWidth: 700, //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                    $SlideHeight: 300, //[Optional] Height of every slide in pixels, default value is height of 'slides' container
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
<?php
$slides = $this->requestAction(array('controller' => 'posts', 'action' => 'slides'));

?>
<div id="slider">
    <div id="slider1_container" style="position: relative; top: 10px; left: 0px; width: 700px; height: 300px;">
        <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0px; top: 0px; width: 700px; height: 300px;">
            <?php foreach ($slides as $slide): ?>
                <div>
                    <?php
                    if(empty($slide['Post']['image'])){
                       echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/df-img.jpg&amp;h=300&amp;w=700');
                    }else{      
                    echo $this->Html->image(FULL_BASE_URL . '/newblog/app/webroot/img/' . '/timthumb.php?src=' . FULL_BASE_URL . '/newblog/app/webroot/img/upload/' . $slide['Post']['image'] . '&amp;h=300&amp;w=700');
                    }
                    ?>
                    <div class='contentSlides'>
                    <div  class='titleSlides'><?php echo $slide['Post']['title']; ?></div>
                    <div class='excepSlides' ><?php echo $slide['Post']['excerp']; ?></div>
                    <div  class='buttonSdiles' >
                         <?php echo $this->Html->image('btn_more.png', array('url' => array('controller' => 'posts', 'action' => 'view', $slide['Post']['id']))); ?>
                    </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>

        </div>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora21l"
              style="width: 55px; height: 55px; top: 122px; left: 8px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora21r"
              style="width: 55px; height: 55px; top: 122px; right: 8px;">
        </span>

        <!-- Arrow Navigator Skin End -->

    </div>
</div>