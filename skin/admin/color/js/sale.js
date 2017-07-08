function updateOrderStatus(status)
{
    if(isItemChecked())
    {
        jQuery('#params').val(status);
        submitbutton('updateStatus');
    }
}