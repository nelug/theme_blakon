
/*
productos.js
*/

$(function() {
    $(document).on("click", "#Inv_dt_open", function(){ Inv_dt_open(this); });
    $(document).on("click", "#new_producto", function(){ new_producto(this); });
    $(document).on("click", "#logs_productos", function(){ logs_productos(this); });
});

function Inv_dt_open() {

    $.get( "admin/datatables/inventario_dt", function( data ) {
        makeTable(data, 'admin/productos/', 'Producto');
    });
};


function logs_productos() {

    $.get( "owner/logs/productos", function( data ) {
        $('.table').html(data);
    });
};

function view_inventario()
{
    $.get( "user/productos/inventario", function( data ) {
        makeTable(data, ' ', 'Inventario');
    });
}



function new_producto()
{
    $.get( "admin/productos/create", function( data ) 
    {
        $('.producto-title').text('Formulario Producto');
        $(".forms-producto").html(data);
        $(".dt-panel").hide();
        $(".form-panel").hide();
        $(".producto-container").show();
        $(".producto-panel").show();
    });
}
