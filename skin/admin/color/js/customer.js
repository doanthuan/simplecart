function customerSuggestion(inputField, valueField)
{
    $('#'+inputField).typeahead({
        source: function (query, process) {
            $.ajax({
                url: '/admin/customer/customer/ajax-search',
                type: 'GET',
                dataType: 'JSON',
                data: 'term=' + query,
                success: function(data) {
                    items = [];
                    map = {};
                    $.each(data, function (i, item) {
                        var name = item.first_name + ' ' + item.last_name;
                        items.push(name);
                        map[name] = item;
                    });
                    process(items);
                }
            });
        },
        updater: function (item) {
            var customer_id = map[item].customer_id;
            $('#'+valueField).val(customer_id);
            return item;
        }
    });
}