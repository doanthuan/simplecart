<script src="{{url('media/bootstrap/js/bootstrap3-typeahead.min.js')}}"></script>

<input id="category-suggestion" class="form-control" name="categories" type="text">

<div id="category-suggestion-list" class="suggestion-list"></div>

<script>
    var options = {
        source: function (query, process) {
            getCategorySource(query, process);
        },
        updater: function (item) {
            return updateCategoryItem(item);
        }
    };

    function updateCategoryItem(item)
    {
        addCategory(map[item].name, map[item].category_id);
        //return item;
    }

    function addCategory(categoryName, categoryId)
    {
        //create new row
        var html = '<div class="row">' +
            '<div class="col-sm-10">' + categoryName +
            '<input type="hidden" name="category-suggestion-list[]" value="'+categoryId+'">' +
            '</div>' +
            '<div class="col-sm-2 text-right">' +
            '<a href="#" onclick="return removeCategory(this)"><img src="{{url('skin/admin/base/images/delete.png')}}"></a>' +
        '</div>' +
    '</div>';

        $('#category-suggestion-list').append(html);
    }

    function removeCategory(element)
    {
        $(element).closest('.row').remove();
        return false;
    }

    $('#category-suggestion').typeahead(options);

    <?php if(isset($categories)) {
        foreach($categories as $category ) { ?>
    addCategory('{{$category->name}}', '{{$category->category_id}}');
    <?php }
    }
    ?>

</script>