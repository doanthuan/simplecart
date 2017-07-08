<div id="footer">
    <div class="container">
        @section('footer')
        @show
    </div>
</div>
<script>
    $(document).ready(function(){
        $( 'input[required="required"]')
            .closest(".form-group")
            .children("label")
            .append("<i class='glyphicon-asterisk'></i> ");
    });
</script>