<button type="button" class="btn btn-sm btn-primary" onclick="addProduct()">Add Product</button>
<br/><br/>
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
    <tr>
        <th>{{trans('Products')}}</th>
        <th>{{trans('Price')}}</th>
        <th class="col-md-2">{{trans('Quantity')}}</th>
        <th class="col-md-2">{{trans('Total')}}</th>
        <th class="col-md-1"></th>
    </tr>
    </thead>
    <tbody id="cart-list">

    </tbody>
    <tfoot id="tfoot" style="display: none;">
    <tr>
        <td colspan="2"></td>
        <td><label>{{trans('Grand Total')}}</label></td>
        <td><span id='grand-total'>0</span></td>
    </tr>
    </tfoot>
</table>

<input type="hidden" name="total_amount" id="total_amount" value="">

<script>
    var rowIndex = 0;
    var options = {
        source: function (query, process) {
            getSource(query, process);
        },
        updater: function (item) {
            return updateItem(item);
        }
    };


    function getSource(query, process)
    {
        $.ajax({
            url: '{{url('products/ajax-search')}}/'+query,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                items = [];
                map = {};
                $.each(data, function (i, item) {
                    items.push(item.name);
                    map[item.name] = item;
                });
                process(items);
            }
        });
    }

    function updateItem(item)
    {
        //set value for current row
        var product_id = map[item].product_id;
        var price = map[item].price;

        $('#product_id_'+rowIndex).val(product_id);
        $('#price'+rowIndex).text(price);
        $('#quantity'+rowIndex).val(1);
        $('#total'+rowIndex).text(price);

        updateTotal();

        return item;
    }

    function addProduct()
    {
        rowIndex++;

        //create new row
        var html = '<tr id="tr'+rowIndex+'"><td><input type="text" name="product_name[]" id="product_name'+rowIndex+'" class="form-control" placeholder="Enter Product Name"></td>' +
            '<td><span id="price'+rowIndex+'"></span></td>' +
            '<td><input type="text" name="quantity[]" class="form-control" id="quantity'+rowIndex+'"></td>' +
            '<td><span id="total'+rowIndex+'"></span></td>'+
            '<td><button type="button" class="btn btn-sm btn-danger" onclick="removeProduct(\''+rowIndex+'\')">Remove</button></td></tr>';
        html += '<input type="hidden" name="product_ids[]" id="product_id_'+rowIndex+'">';
        $('#cart-list').append(html);

        $('#product_name'+rowIndex).typeahead(options);

        $('#tfoot').show();
    }

    function removeProduct(i)
    {
        $('#tr'+i).remove();
        $('#product_id_'+i).remove();

        if(i == 1)
        {
            $('#tfoot').hide();
        }
        rowIndex--;

        updateTotal();
    }

    function updateTotal()
    {
        var totalPrice = 0;
        for(var i = 1; i <= rowIndex; i++)
        {
            var price = parseFloat($('#total'+i).text());
            totalPrice += price;
        }
        $('#grand-total').text(totalPrice);
        $('#total_amount').val(totalPrice);
    }

</script>