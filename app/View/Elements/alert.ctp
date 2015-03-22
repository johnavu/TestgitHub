<div class="alert-message <?php echo $class; ?>">
    <div class="box-icon"></div> 
    <p><?php echo $message;?><a href="" class="close">&times;</a> 
</div>
<script type="text/javascript">
    $(function () {
        $(".alert-message").delegate("a.close", "click", function (event) {
            event.preventDefault();
            $(this).closest(".alert-message").fadeOut(function (event) {
                $(this).remove();
            });
        });
    });
</script>
