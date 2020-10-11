$(document).ready(function () {
    // global call of csrf token. use ajax call below this function
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
    });

    // get category's attributes
    $('.categorySelect').change(function(){
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
                let data = '<div class="form-group">'+
                    '<label>'+fieldName+'</label>'+
                    '<select name="'+fieldName+'[]" multiple class="form-control">';

                $.each(field, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'+
                    '</div>';

                $('#attributeFields').append(data);
            });

            event.preventDefault(); // prevent from going ajax's post url
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
            event.preventDefault(); // prevent from going ajax's post url
        });
    });

    // get dynamic sub category attributes
    $('#subCategory').on('change', '.categorySelect', function() {
        let categoryId = $(this).val();

        $.ajax({
            type  	 : "POST",
            url   	 : "/admin/get-category-attirbutes-with-options",
            data  	 : {catgoryId: categoryId},
            async  	 : false,
            dataType : 'json'
        }).done(function(resp){
            let fields = resp;
            $('#attributeFields').empty();

            $.each(fields, function(fieldName, field) {
                let data = '<div class="form-group">'+
                    '<label>'+fieldName+'</label>'+
                    '<select name="'+fieldName+'[]" multiple class="form-control">';

                $.each(field, function(key, value) {
                    data += '<option value="'+key+'">'+value+'</option>';
                });
                data += '</select>'+
                    '</div>';

                $('#attributeFields').append(data);
            });

            event.preventDefault(); // prevent from going ajax's post url
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
            event.preventDefault(); // prevent from going ajax's post url
        });
    });


    // save staic pages data
    $('#staticpagesForm').submit(function(e){

        e.preventDefault();

        let data = {
            'about_us': $('#editorAboutus').val(),
            'shipping_policy': $('#editorShipping').val(),
            'return_policy': $('#editorReturn').val(),
            'term_and_conditions': $('#editorTerms').val(),
            'privacy_policy': $('#editorPrivacy').val(),
            'how_to_buy': $('#editorHowtobuy').val()
        };

        $.ajax({
            type     : "POST",
            url      : "/admin/static-pages/update",
            data     : data,
            async    : true,
        }).done(function(resp){
            console.log(resp);
            if(resp.status == 'success'){
                $.notify({
                    icon: 'pe-7s-check',
                    message: resp.message
                },{
                    type: 'success',
                    timer: 4000
                });
            }
            else if(resp.status == 'error'){
                $.notify({
                    icon: 'pe-7s-check',
                    message: resp.message
                },{
                    type: 'danger',
                    timer: 4000
                });
            }
        }).fail(function(resp){
            alert("Something went wrong. Please try again");
        });
    });
});