
<div class="widget-search widget">
    
    <form id="search-form-content" action="http://localhost/newblog/search/index" method="get">
        
        <div>
            <input id="s" class="input" type="text" name="con" onblur="if (this.value == '') {
                        this.value = 'Type for search';
                    }" onfocus="if (this.value == 'Type for search') {
                                this.value = '';
                            }" value="Type for search">
            <input id="searchsubmit" class="btn-submit" type="submit" value="Submit">
        </div>
    </form>
</div>
<?php //die('sssssssssssssssss');?>