$("document").ready(function() {
    $('#table-detail').on('click', '.btn-danger', function(event) {
        event.preventDefault();
        currentLink = $(this);
        currentLinkHref = currentLink.attr('href');
        currentLink.closest('tr').fadeOut(600,function(){
            $(this).remove();
        });
        $.ajax({
            type:"GET",
            url: currentLinkHref
        }).done(function(){
            currentLink.parents('tr').fadeOut(600,function(){
                $(this).remove();
            });
        });
    });
});