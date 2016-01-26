$("document").ready(function() {
    $(".zipcode").keyup(function() {
        if ($(this).val().length === 5) {
            $.ajax({
                type: 'get',
                url: Routing.generate('ticme_front_address_city', { zipcode: $(this).val() }),
                //url: 'http://localhost/upload_multiple/web/app_dev.php/city/' + $(this).val(),
                beforeSend: function() {
                    if ($(".loading").length == 0) {
                        $("form .city").parent().append('<div class="loading"></div>');
                    }
                    $(".city option").remove();
                },
                success: function(data) {
                    console.log(data);
                    $.each(data.cities, function(index,value) {
                        $(".city").append($('<option>',{ value : value , text: value }));
                    });
                    $(".loading").remove();
                }
            });
        } else {
            $(".city").val('');
        }
    });
});