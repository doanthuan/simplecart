<div class="row">
    <div class="col-sm-4 col-sm-offset-1">
        <p class="help-block">Select existing customer</p>
        <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name">
    </div>
    <div class="col-sm-4 col-sm-offset-2">
        <p class="help-block">Guest customer</p>
        <input type="text" class="form-control" name="customer_email" placeholder="Enter Email">
    </div>
</div>

<input type="hidden" name="customer_id" id="customer_id">

<script>
    $(document).ready(function(){
        customerSuggestion('customer_name', 'customer_id');
    });
</script>
