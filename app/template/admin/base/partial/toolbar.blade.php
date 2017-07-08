<div class="page-header">
<div class="row">
    <div class="col-sm-6">
            <h2>{{ $title }}</h2>
    </div>
    <div class="col-sm-6 text-right btn-toolbar">
        <?php foreach($buttons as $button){
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_CREATE)
            {
                $button['label'] = !isset($button['label'])?trans('Create'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-success" onclick="setLocation('<?php echo $createUrl;?>')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_DELETE)
            {
                $button['label'] = !isset($button['label'])?trans('Delete'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-danger" onclick="deleteItems()">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_SAVE)
            {
                $button['label'] = !isset($button['label'])?trans('Save'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="submitbutton('')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_CANCEL)
            {
                $button['label'] = !isset($button['label'])?trans('Cancel'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-default" onclick="setLocation('<?php echo $objectUrl;?>')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_BACK)
            {
                $button['label'] = !isset($button['label'])?trans('Back'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="goBack()">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_REDIRECT)
            {
                $button['label'] = !isset($button['label'])?trans('Custom'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="setLocation('{{$button['url']}}')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_SUBMIT)
            {
                $button['label'] = !isset($button['label'])?trans('Custom'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="submitbutton('{{$button['action']}}')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_UPLOAD)
            {
                $button['label'] = !isset($button['label'])?trans('Upload'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="submitbutton('')">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_PUBLISH)
            {
                $button['label'] = !isset($button['label'])?trans('Publish'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="publishItems()">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_UNPUBLISH)
            {
                $button['label'] = !isset($button['label'])?trans('UnPublish'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="unPublishItems()">{{$button['label']}}</button>
            <?php
            }
            if($button['type'] == \Goxob\Core\Html\Toolbar::BUTTON_CLICK)
            {
                $button['label'] = !isset($button['label'])?trans('Button'):$button['label'];
                ?>
                <button type="button" class="btn btn-sm btn-primary" onclick="{{$button['onclick']}}">{{$button['label']}}</button>
            <?php
            }
        }?>
    </div>
    </div>
</div>