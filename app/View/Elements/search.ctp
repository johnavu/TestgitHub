
<div class="widget-search widget">
    <h3 class="widget-title">Search</h3>
    <form id="search-form-content" action="http://localhost/newblog/search/index" method="get" class='form' role="form">

        <div class="form-group search">
            <input id="s1" class="input" type="text" name="con" onblur="if (this.value == '') {
                        this.value = 'Type for search';
                    }" onfocus="if (this.value == 'Type for search') {
                                this.value = '';
                            }" value="Type for search">
            <input id="searchsubmit1" class="btn-submit" type="submit" value="Submit">

        </div>

    </form>
    <span>Search By:</span>
    <div class="form-group">
        <label>
            <input type="radio" name="inlineRadioOptions" id="inlineRadioOptions1" value="con" >Content
        </label>
        <label>
            <input type="radio" name="inlineRadioOptions" id="inlineRadioOptions2" value="cat">Category
        </label>
        <label>
            <input type="radio" name="inlineRadioOptions" id="inlineRadioOptions3" value="tag">Tag
        </label>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var radio = 'input:radio[name=inlineRadioOptions]';
        $(radio).click(function () {
            var val = $(this).val();
            $('#s1').prop('name', val);
        });
    });
</script>