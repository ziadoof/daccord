$(function(){
    $("#offer_generalcategory").change(function(){
        var data = {
            generalcategory_id: $(this).val()
        };
        var url = Routing.generate('select_category');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $category_selector = $('#offer_category');

                $category_selector.html('<option>Category</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $category_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
            }
        });
    });
});
$(function(){
    $("#demand_generalcategory").change(function(){
        var data = {
            generalcategory_id: $(this).val()
        };
        var url = Routing.generate('select_category');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $category_selector = $('#demand_category');

                $category_selector.html('<option>Category</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $category_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
            }
        });
    });
});
/// search bar

$(function(){
    $("#offer_search_generalcategory").change(function(){

        var data = {
            generalcategory_id: $(this).val()
        };
        var url = Routing.generate('select_category');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {

                var $category_selector = $('#offer_search_category');

                $category_selector.html('<option value="">' + 'All categorys' + '</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $category_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
            }
        });
    });
});
$(function(){
    $("#demand_search_generalcategory").change(function(){
        var data = {
            generalcategory_id: $(this).val()
        };
        var url = Routing.generate('select_category');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $category_selector = $('#demand_search_category');

                $category_selector.html('<option value="">' + 'All categorys' + '</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $category_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
            }
        });
    });
});



