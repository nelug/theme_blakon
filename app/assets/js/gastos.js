$(function() {
    $(document).on('click', '#f_gastos', function(){ f_gastos(this); });
});


function f_gastos() {
    $.get( "user/gastos/create", function( data ) {
        $('.modal-body').html(data);
        $('.modal-title').text('Ingresar Gasto');
        $('.bs-modal').modal('show');
    });
}