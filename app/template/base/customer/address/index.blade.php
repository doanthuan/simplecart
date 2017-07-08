@extends('master.customer')

@section('content')

    <h2>{{trans('Address Book Entries')}}</h2>
    <hr>

<?php echo Form::open( array('id' => 'address-list') )?>
    <?php foreach($addresses as $address){?>
    <div class="content row">
        <div class="col-sm-6">
            <table>
                <tbody><tr>
                    <td>{{{$address->first_name.' '.$address->last_name}}}
                        <br>{{{$address->address}}}
                        <br>{{{$address->city}}}
                        <br>{{{$address->state}}}&nbsp;{{{$address->zipcode}}}
                        <br>{{{$address->type==0?trans('Billing Address'):trans('Shipping Address')}}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6 text-right">
            <button class="btn btn-sm btn-primary" onclick="return editAddress({{$address->address_id}})">{{trans('Edit')}}</button>
            <button class="btn btn-sm btn-danger" onclick="deleteAddress({{$address->address_id}})">{{trans('Delete')}}</button>
        </div>
    </div>
    <?php } ?>
<input type="hidden" name="address_id" id="address_id">
<?php echo Form::close()?>

<script>
function editAddress(id)
{
    var url = '{{url('customer/address/edit')}}/'+id;
    setLocation(url);
    return false;
}
function deleteAddress(id)
{
    $('#address_id').val(id);
    submitForm('#address-list', '{{url('customer/address/delete')}}');
}
</script>


@stop