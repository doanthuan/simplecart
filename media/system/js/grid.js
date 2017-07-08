function checkAll(checkbox, stub) {
    if (!stub) {
        stub = 'cb';
    }
    if (checkbox.form) {
        var c = 0;
        for (var i = 0, n = checkbox.form.elements.length; i < n; i++) {
            var e = checkbox.form.elements[i];
            if (e.type == checkbox.type) {
                if ((stub && e.id.indexOf(stub) == 0) || !stub) {
                    e.checked = checkbox.checked;
                    c += (e.checked == true ? 1 : 0);
                }
            }
        }
        if (checkbox.form.boxchecked) {
            checkbox.form.boxchecked.value = c;
        }
        return true;
    } else {
        // The old way of doing it
        var f = document.adminForm;
        var c = f.toggle.checked;
        var n = checkbox;
        var n2 = 0;
        for (var i = 0; i < n; i++) {
            var cb = f[stub+''+i];
            if (cb) {
                cb.checked = c;
                n2++;
            }
        }
        if (c) {
            document.adminForm.boxchecked.value = n2;
        } else {
            document.adminForm.boxchecked.value = 0;
        }
    }
}

function isItemChecked()
{
    var n = jQuery( "input[name=cid\\[\\]]:checked" ).length;
    if (n==0){
        alert('Please first make a selection from the list');
        return false;
    }else{
        return true;
    }
}

function deleteItems()
{
    if(isItemChecked())
    {
        if(!confirm("Do you want to delete all selected records?"))
        {
            return false;
        }
        submitbutton('delete');
    }
}

function publishItems()
{
    if(isItemChecked())
    {
        jQuery('#params').val(1);
        submitbutton('publish');
    }
}

function unPublishItems()
{
    if(isItemChecked())
    {
        jQuery('#params').val(0);
        submitbutton('publish');
    }
}

function gridSort(orderBy, orderDir){
    $('#filter_order').val(orderBy);
    $('#filter_order_dir').val(orderDir);
    submitbutton('setFilter');
}

//for grid publish
function listItemTask(id, task, value) {
    var f = document.adminForm;
    var cb = f[id];
    if (cb) {
        for (var i = 0; true; i++) {
            var cbx = f['cb'+i];
            if (!cbx)
                break;
            cbx.checked = false;
        } // for
        cb.checked = true;
        f.boxchecked.value = 1;
        f.params.value = value;
        submitbutton(task);
    }
    return false;
}

function saveSortOrder(task, count)
{
    jQuery('input[name=toggle]').eq(0).trigger('click');
    checkAll(count);

    submitbutton(task);
}


