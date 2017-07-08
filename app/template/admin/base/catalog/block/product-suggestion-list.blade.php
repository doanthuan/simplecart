<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>

<input id="product-suggestion" class="form-control" name="products" type="text">

<div id="product-suggestion-list" class="suggestion-list"></div>

<script>
    var options = {
        source: function (query, process) {
            getProductSource(query, process);
        },
        updater: function (item) {
            return updateProductItem(item);
        }
    };

    function updateProductItem(item)
    {
        addProduct(map[item].name, map[item].product_id);
        //return item;
    }

    function addProduct(productName, productId)
    {
        //create new row
        var html = '<div class="row">' +
            '<div class="col-sm-10">' + productName +
            '<input type="hidden" name="product-suggestion-list[]" value="'+productId+'">' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<a href="#" onclick="return removeProduct(this)"><img src="{{url('skin/admin/base/images/delete.png')}}"></a>' +
        '</div>' +
    '</div>';

        $('#product-suggestion-list').append(html);
    }

    function removeProduct(element)
    {
        $(element).closest('.row').remove();
        return false;
    }

    $('#product-suggestion').typeahead(options);

    <?php if(isset($products)) {
        foreach($products as $product ) { ?>
    addProduct('{{$product->name}}', '{{$product->product_id}}');
    <?php }
    }
    ?>

</script>