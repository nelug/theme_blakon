$(function() {
    $(document).on("click", "#graph_g", function(){ graph_g(this); });
    $(document).on("click", "#graph_v", function(){ graph_v(this); });
    $(document).on("click", "#graph_s", function(){ graph_s(this); });
});


function graph_g() {
    clean_panel();

    $.get('owner/chart/gastos', function (data) {
        $('.dt-container').show();
        $('.table').html(data);
    }); 
}


function graph_v() {
    clean_panel();

    $.get('owner/chart/ventas', function (data) {
        $('.dt-container').show();
        $('.table').html(data);
    }); 
}


function graph_s() {
    clean_panel();

    $.get('owner/chart/soporte', function (data) {
        $('.dt-container').show();
        $('.table').html(data);
    }); 
}