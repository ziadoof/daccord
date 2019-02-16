$(function(){
    $("#offer_generalcategory").change(function(){
        var data = {
            generalcategory_id: $(this).val()
        };
        var url = Routing.generate('select_subcategory');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $subcategory_selector = $('#offer_subcategory');

                $subcategory_selector.html('<option>Sub category</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $subcategory_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }

                $('#offer_category').html("<option>Category</option>");
            }
        });

    });

    $("#offer_subcategory").change(function(){
        var data = {
            subcategory_id: $(this).val()
        };
        var url = Routing.generate('select_category');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function(data) {
                var $category_selector = $('#offer_category');

                $category_selector.html('<option>category</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    $category_selector.append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
            }
        });
    });
});






