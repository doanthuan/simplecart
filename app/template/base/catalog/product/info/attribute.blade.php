<table class="attribute">
    <tbody>
    <?php foreach($attributes as $attr){?>
        <tr>
            <td>
                <?php echo ucfirst($attr->label); ?>
            </td>
            <td>
                <?php echo ucfirst($attr->pivot->attr_value); ?>
            </td>
        </tr>
    <?php }?>
    </tbody>
</table>
