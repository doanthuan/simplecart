function submitbutton(pressbutton) {
    $form = jQuery('form[name="adminForm"]' ).first();
    if (pressbutton) {
        $task = $form.find('input[name="task"]').first();
        if($task)
        {
            $task.val(pressbutton);
        }
    }
    if(!!$.prototype.valid)
    {
        if($form.valid())
        {
            $form.submit();
        }
    }
    else{
        $form.submit();
    }
}

function submitForm(selector, url)
{
    $form = $(selector);
    if(url){
        $form.attr('action', url);
    }
    console.log($form);
    $form.submit();
}

function setLocation(url)
{
    window.location = url;
}

function goBack()
{
    window.history.back();
}

function initMCE(selector)
{
    tinymce.init({
        selector: selector,
        theme: "modern",
        plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor"
        ],
        'relative_urls': false,
        //content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
        {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
    });
}

function getProductSource(query, process)
{
    $.ajax({
        url: '/products/ajax-search/'+query,
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

function getCategorySource(query, process)
{
    $.ajax({
        url: '/categories/ajax-search/'+query,
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

function updateOrderStatus(status)
{
    if(isItemChecked())
    {
        jQuery('#params').val(status);
        submitbutton('updateStatus');
    }
}