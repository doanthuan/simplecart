<?php
$html = '';
$prev_level = null;

foreach($categories as $i => $cat)
{
    $catNode = "";

    if($prev_level !== null){
        if( $cat->tree_level > $prev_level)
        {
            $catNode .= "<ul>";
        }
        if( $cat->tree_level == $prev_level)
        {
            $catNode .= "</li>";
        }
        if( $cat->tree_level < $prev_level)
        {
            for( $j = 0 ; $j <  $prev_level - $cat->tree_level; $j++ )
            {
                $catNode .= "</ul></li>";
            }
        }
    }
    $catLink = \Goxob\Catalog\Helper\Category::getLink($cat);
    if(isset($cat->product_count))
    {
        $cat->name .= ' ('. $cat->product_count .')';
    }
    $catNode .= "<li><a href='".$catLink."'>".$cat->name."</a>";


    $prev_level = $cat->tree_level;
    $html .= $catNode;
}

//closet
if(isset($prev_level))
{
    for($i = 0 ;$i < $prev_level; $i++)
    {
        $html .= "</li></ul>";
    }
    $html .= "</li>";
}
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <?php echo $title;?>
    </div>
    <div class="panel-body">
        <div class="hidden-sm category-block">
            <ul class="nav">
                <?php echo $html;?>
            </ul>
        </div>
    </div>
</div>