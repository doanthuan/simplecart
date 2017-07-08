<?php
$html = '';
$prev_level = null;

foreach($categories as $i => $cat)
{
    $catNode = "";

    if($prev_level !== null){
        if( $cat->tree_level > $prev_level)
        {
            $catNode .= '<ul class="dropdown-menu">';
        }
        if( $cat->tree_level == $prev_level)
        {
            $catNode .= '</li>';
        }
        if( $cat->tree_level < $prev_level)
        {
            for( $j = 0 ; $j <  $prev_level - $cat->tree_level; $j++ )
            {
                $catNode .= '</ul></li>';
            }
        }
    }
    $catLink = \Goxob\Catalog\Helper\Category::getLink($cat);
    $liClcs = '';
    if($cat->tree_level == 0){
        $liClcs = 'class="dropdown"';
    }
    elseif($cat->child_count > 0){
        $liClcs = 'class="dropdown-submenu"';
    }
    $catNode .= "<li {$liClcs}><a href='".$catLink."'>".$cat->name."</a>";


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
<div class="navbar navbar-inverse " role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <?php echo $html;?>
        </ul>
    </div>
</div>
