<?php if(!is_null($address) && !empty($address)){?>
<address>
    <strong>{{{$address->first_name.' '.$address->last_name}}}</strong>
    <br>{{{$address->address}}}
    <br>{{{$address->city}}}, {{{$address->state}}}&nbsp;{{{$address->zipcode}}}
    <br><abbr title="Phone">P:</abbr> {{{$address->phone}}}
</address>
<?php }?>