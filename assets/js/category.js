import Translator from 'bazinga-translator';

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
                let all_category = Translator.trans('Category');

                $category_selector.html('<option value="">' + all_category + '</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    let name = Translator.trans(data[i].name);
                    $category_selector.append('<option value="' + data[i].id + '">' + name + '</option>');
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

                let all_category = Translator.trans('Category');

                $category_selector.html('<option value="">' + all_category + '</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    let name = Translator.trans(data[i].name);
                    $category_selector.append('<option value="' + data[i].id + '">' + name + '</option>');
                }
            }
        });
    });
});
/// search bar

$(function(){
    $("#offer_search_generalcategory").change(function(){
        $('#dynamic_form').hide();
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
                let all_category = Translator.trans('Category');

                $category_selector.html('<option value="">' + all_category + '</option>');
                for (var i=0, total = data.length; i < total; i++) {
                    let name = Translator.trans(data[i].name);
                    $category_selector.append('<option value="' + data[i].id + '">' + name + '</option>');
                }
            }
        });
    });
});
$(function(){
    $("#demand_search_generalcategory").change(function(){
        $('#demand_dynamic_form').hide();
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

                let all_category = Translator.trans('Category');

                $category_selector.html('<option value="">' + all_category + '</option>');

                for (var i=0, total = data.length; i < total; i++) {
                    let name = Translator.trans(data[i].name);
                    $category_selector.append('<option value="' + data[i].id + '">' + name + '</option>');
                }
            }
        });
    });
});



