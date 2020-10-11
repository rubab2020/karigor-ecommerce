$(document).ready(function () {
    // global call of csrf token. use ajax call below this function
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
    });

    // -------------------------
    // sub category load
    // -------------------------
    $('#categorySelect').change(function() {
        event.preventDefault();

        let categoryId = $(this).val();

        $.ajax({
            type     : "POST",
            url      : "/get-child-categories",
            data     : {category_id: categoryId},
        }).done(function(resp){
            if(Object.keys(resp.data).length > 0){
                let data = '<div class="form-group row">'
                    +'<label class="col-sm-2 col-form-label" >Sub Category</label>'
                    +'<div class="col-sm-10">'
                    +'<select name="sub_category_id" class="form-control" id="categorySubSelect">';

                data += '<option value="">Please Select Sub Category</option>';
                $.each(resp.data, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'
                    + '</div></div>';

                $('#subCategory').empty().append(data);
                $('#subSecondaryCategory').empty();
            }
            else{
                $('#subCategory').empty();
            }
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
        });
    });

    // -------------------------
    // sub secondsary category load
    // -------------------------
    $('#subCategory').on('change', '#categorySubSelect', function() {
        event.preventDefault();

        let categoryId = $(this).val();
        console.log(categoryId);

        $.ajax({
            type     : "POST",
            url      : "/get-child-categories",
            data     : {category_id: categoryId},
        }).done(function(resp){
            if(Object.keys(resp.data).length > 0){
                let data = '<div class="form-group row">'
                    + '<label class="col-sm-2 col-form-label">Sub Secondary Category</label>'
                    +'<div class="col-sm-10">'
                    + '<select name="sub_secondary_category_id" class="form-control" id="categorySubSecondrySelect">';

                data += '<option value="">Please Select Sub Secondary Category</option>';
                $.each(resp.data, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'
                    +  '</div></div>';

                $('#subSecondaryCategory').empty().append(data);
            }
            else{
                $('#subSecondaryCategory').empty();
            }
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
        });
    });

    // -------------------------
    // get category's attributes
    // -------------------------
    $('#categorySelect').change(function(){
        let categoryId = $(this).val();

        $.ajax({
            type     : "POST",
            url      : "/admin/get-category-attirbutes-with-options",
            data     : {catgoryId: categoryId},
            async    : false,
            dataType : 'json'
        }).done(function(resp){
            let fields = resp;
            $('#attributeFields').empty();

            $.each(fields, function(fieldName, field) {

                let data = '<div class="form-group row">'+
                    '<label class="col-sm-2 col-form-label">'+fieldName+'</label>'
                    +'<div class="col-sm-10">'
                    +'<select name="'+fieldName+'[]" multiple class="form-control">';

                $.each(field, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'+
                    '</div></div>';

                $('#attributeFields').append(data);
            });

            event.preventDefault(); // prevent from going ajax's post url
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
            event.preventDefault(); // prevent from going ajax's post url
        });
    });

    // -------------------------
    // get dynamic sub category attributes
    // -------------------------
    $('#subCategory').on('change', '#categorySubSelect', function() {
        event.preventDefault();

        let categoryId = $(this).val();

        $.ajax({
            type     : "POST",
            url      : "/admin/get-category-attirbutes-with-options",
            data     : {catgoryId: categoryId},
            async    : false,
            dataType : 'json'
        }).done(function(resp){
            let fields = resp;
            $('#attributeFields').empty();

            $.each(fields, function(fieldName, field) {
                let data = '<div class="form-group row">'
                    +'<label class="col-sm-2 col-form-label">'+fieldName+'</label>'
                    +'<div class="col-sm-10">'
                    +'<select name="'+fieldName+'[]" multiple class="form-control">';

                $.each(field, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'+
                    '</div></div>';

                $('#attributeFields').append(data);
            });
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
        });
    });

    // -------------------------
    // get dynamic sub secondary category attributes
    // -------------------------
    $('#subSecondaryCategory').on('change', '#categorySubSecondrySelect', function() {
        event.preventDefault();

        let categoryId = $(this).val();

        $.ajax({
            type     : "POST",
            url      : "/admin/get-category-attirbutes-with-options",
            data     : {catgoryId: categoryId},
            async    : false,
            dataType : 'json'
        }).done(function(resp){
            let fields = resp;
            $('#attributeFields').empty();

            $.each(fields, function(fieldName, field) {
                let data = '<div class="form-group row">'
                    +'<label class="col-sm-2 col-form-label">'+fieldName+'</label>'
                    +'<div class="col-sm-10">'
                    +'<select name="'+fieldName+'[]" multiple class="form-control">';

                $.each(field, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'+
                    '</div></div>';

                $('#attributeFields').append(data);
            });
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
        });
    });

    // -------------------------
    // stock toggle for product
    // -------------------------
    $('.stock-toggle').change(function(){
        let productId = $(this).attr('data-productid');
        $.ajax({
            type     : "POST",
            url      : "/merchant/product-visibility-update",
            data     : {product_id: productId},
            async    : true,
        }).done(function(resp){
            event.preventDefault();

            console.log(resp);
        }).fail(function(resp){
            event.preventDefault();
            alert("Something went wrong. Please try again");
        });
    });

    // -------------------------
    // change discounted price
    // -------------------------
    $('.discount-calc-fld').change(function(){
        let originalPrice = $('#originalPriceField').val();
        let discountPercent = $('#discountPercentField').val();
        // console.log(originalPrice, discountPercent);
        if(originalPrice !== '' && discountPercent !== ''){
            let discountPrice = originalPrice * (discountPercent / 100);
            let discountedPrice = Math.round(originalPrice - discountPrice);
            $('#discountedPriceField').val(discountedPrice);
        }
        else{
           $('#discountedPriceField').val(null); 
        }
    });

    // -------------------------
    // change discount percent
    // -------------------------
    // $('.discount-calc-fld').change(function(){
    //     let originalPrice = $('#originalPriceField').val();
    //     let discountedPrice = $('#discountedPriceField').val();
    //     if(originalPrice !== '' && discountedPrice !== ''){
    //         let currentPricePercent = (discountedPrice / originalPrice) * 100;
    //         let discountPercent = Math.round(100 - currentPricePercent); // 100 percent
    //         $('#discountPercentField').val(discountPercent);
    //     }
    //     else{
    //        $('#discountPercentField').val(null); 
    //     }
    // });
});

// function isInteger(x) { return typeof x === "number" && isFinite(x) && Math.floor(x) === x; }
// function isFloat(x) { return !!(x % 1); }
