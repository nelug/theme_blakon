$(function() {
    $(document).on('click', '#proveedores', function() { proveedores(); });
    $(document).on('click', '#proveedor_edit', function() { proveedor_edit(); });
    $(document).on('click', '#proveedor_create', function() { proveedor_create(); });
    $(document).on('click', '#proveedor_help', function() { proveedor_help(); });
    $(document).on('click', '#contacto_create', function() { contacto_create(); });
});

function proveedores() {

    $.get( "user/proveedor/index", function( data ) {
        makeTable(data, 'user/proveedor/', 'Proveedor');
    });
};

function proveedor_help() {

    $id = $("input[name='proveedor_id']").val();
    
    if($id > 0)
    {
        $.ajax({
            type: "GET",
            url: "user/proveedor/help",
            data: {id: $id},
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                $('.modal-body').html(data);
                $('.modal-title').text('Informacion del Proveedor');
                $('.bs-modal').modal('show');
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }
};

function proveedor_create() {
    $.get( "user/proveedor/create", function( data ) {
        $('.modal-body').html(data);
        $('.modal-title').text('Crear Proveedor');
        $('.bs-modal').modal('show');
    });
};


function proveedor_edit() {

    $id = $("input[name='proveedor_id']").val();
    if($id > 0)
    {
        $.ajax({
            type: "POST",
            url: "user/proveedor/edit",
            data: {id: $id},
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                $('.modal-body').html(data);
                $('.modal-title').text('Editar proveedor');
                $('.bs-modal').modal('show');
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    }
};

function contacto_create()
{
    var FormData = $('form[data-remote-contact]').serialize()+
    '&proveedor_id='+$("input[name='proveedor_id']").val();

    $.ajax({
        type: "POST",
        url: "user/proveedor/contacto_create",
        data: FormData,
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {

            
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}
