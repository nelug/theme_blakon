$(function() {
    $(document).on('click', '#f_egresos', function(){ f_egresos(this); });
});


function f_egresos() {

    $(".forms").html("");

    $.get( "user/form/egresos", function( data ) {
        $(".forms").html(data);
    });
}