<?php echo Form::row('dropdown', 'Columns of products', 'display[product_cols]', $item['display']['product_cols'], null,
    array(
        'collection' => array(2, 3, 4, 6)
    ),
    'col-sm-2'
);?>

<?php echo Form::row('dropdown', 'Default Page Size', 'display[default_page_size]', $item['display']['default_page_size'], null,
    array(
        'collection' => array(10, 20, 30, 50)
    ),
    'col-sm-2'
);?>
