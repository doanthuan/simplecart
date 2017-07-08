<?php echo Form::row('dropdown', 'Enable Shipping', 'shipping[enable]', $item['shipping']['enable'], null,
    array(
        'collection' => array(1 => 'Enable' , 0 => 'Disable')
    ),
    'col-sm-2'
);?>