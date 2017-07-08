<div id="footer">
    <div class="container">
        @section('footer')
            @block('cms/content', array('template' => 'cms.block.static-block', 'alias' => 'footer-links'))
        @show
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.required')              .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
        $('[required="required"]')  .closest(".form-group").find("label").append("<i class='glyphicon-asterisk'></i>");
    });
</script>
