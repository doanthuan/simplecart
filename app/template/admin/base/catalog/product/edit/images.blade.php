<style>
    .thumb {
        height: 75px;
        margin: 10px 5px 0 0;
    }
</style>
<script>
    var imgOptions = new Array();
    var imgCount = <?php echo $item->images()->count()?>;
    var imgPath = '<?php echo \Goxob\Catalog\Helper\Product::getProductImageUrl();?>/';
    function addImgOption(name, value, selected)
    {

        var option = document.createElement('option');
        option.innerHTML = name;
        option.value = value;
        if(selected == true){
            option.setAttribute('selected', 'selected');

        }
        var optionImg = [name, value, selected];
        imgOptions.push(optionImg);

        document.getElementById('default_image').insertBefore(option, null);
    }

    function removeImgOptions()
    {
        for(var i = 0; i < imgCount; i++)
        {
            document.getElementById('default_image').remove(0);
        }
    }

    function addImgOptions()
    {
        for(var i = 0; i < imgCount; i++)
        {
            var optionImg = imgOptions[i];

            var option = document.createElement('option');
            option.innerHTML = optionImg[0];
            option.value = optionImg[1];
            if(optionImg[2] == true){
                option.setAttribute('selected', 'selected');
            }
            document.getElementById('default_image').insertBefore(option, null);
        }
    }
</script>

<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Upload Images</label>
    <div class="col-sm-10">
        <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
        <br/><br/><output id="list"></output>
    </div>
</div>

<div class="form-group" style="display: none;" id="select_images">
    <label for="inputEmail3" class="col-sm-2 control-label">Default Image</label>
    <div class="col-sm-10">
        <select name="default_image" id="default_image" class="form-control">
        </select>
    </div>
</div>

<?php if(isset($item->product_id) && $item->images()->count() > 0){?>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Current Images</label>
    <div class="col-sm-10">
        <?php foreach($item->images()->get() as $image){?>
            <div style="float:left; margin-right: 20px; margin-top: 10px;">
                <img src="<?php echo $image->getAbsSrc();?>" height="75px;">
            </div>
            <script>
                addImgOption('<?php echo $image->img_name?>','<?php echo $image->img_id?>', <?php echo $image->default?>);
            </script>
        <?php }?>
    </div>
</div>
<?php }?>

<script>

    document.getElementById('product_images').addEventListener('change', handleFileSelect, false);

    if(imgCount > 0 ){
        document.getElementById('select_images').style.display = "";
    }

    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        var count = 0;
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var div = document.createElement('div');
                    div.innerHTML = [
                        '<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/><br/>'].join('');
                    div.style.float = "left";
                    document.getElementById('list').insertBefore(div, null);

                    addImgOption(escape(theFile.name), "new_"+count);

                    count++;
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }

        document.getElementById('select_images').style.display = "";
    }

    function removeCurrentImages(checked)
    {
        if(checked){
            removeImgOptions();
        }
        else{
            addImgOptions();
        }
    }
</script>