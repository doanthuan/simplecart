<div id="footer">
    <div class="container">
        @section('footer')
        @show
    </div>
</div>
<script>
    $( 'input[required="required"]')
        .closest(".form-group")
        .children("label")
        .append("<i class='glyphicon-asterisk'></i> ");
    $(document).ready(function() {
        App.init();
        //Dashboard.init();
    });
</script>