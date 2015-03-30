$(function() {
    $(document).on('click', '#f_com_op',             function() { f_com_op(this);       });
    $(document).on('click', '#serial-compra',        function() { view_serial(this);    });
    $(document).on('click', '#_edit_producto',       function() { _edit_producto(this); });
    $(document).on('click', '#_add_producto',        function() { _add_producto(this); });
    $(document).on('f10'  , '#compra_save_producto', function() { compra_save_producto();});
    $(document).on('enter', "input[name='ingreso_series']" , function() { compra_save_producto();});
});

function f_com_op() 
{
   $.get( "admin/compras/create", function( data ) 
   {
        $('.panel-title').text('Formulario Compras');
        $(".forms").html(data);
        $(".dt-container").hide();
        $(".producto-container").hide();
        $(".form-panel").show();
    });
}

function compra_save_producto()
{
    form = $('form[data-remote-md-d]');
    compra_id = $("input[name='compra_id']").val();
    formData = form.serialize()+'&compra_id='+compra_id;

    $.ajax({
        type: 'POST',
        url: 'admin/compras/detalle',
        data: formData,
        success: function (data) 
        {
            if (data.success == true) 
            {                        
                msg.success('Producto Ingresado..!', 'Listo!');
                $('.body-detail').html(data.table);
                form.trigger('reset');
                $("input[name='producto_id']").val('');
                $("#search_producto").focus();
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function(errors)
        {
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
        }
    });
};

function save_serie_compra()
{
    var cod = '';
    $("#SerialTable td").each(function() 
    {
        if ($(this).text() === $("input[name='ingreso_series']").val()) 
        {
            cod = $(this).text();
        }
    });

    if (cod === $("input[name='ingreso_series']").val())
    {
        msg.error('la serie ya ha sido ingresada', 'Advertencia!');
    }
    else
    {
        if ($(this).val().trim() === '') 
        {
            msg.warning('El Campo se encuentra vacio...!', 'Advertencia!');
        }
        else 
        {
            var serie = $(this).val().trim();
            var series = $("input[name='serial']").val();

            if($("input[name='serial']").val().trim()==='')
            {
                series = serie;
            }
            else
            {
                series = series+","+serie;
            }
            var myRow = '<tr><td width="100%">'+serie+'</td><td><i class="fa fa-times btn-link theme-c" id="'+series+'" onclick="DeleteSerialCompra(this)"></i></td></tr>';
            $("input[name='serial']").val(series);

            $("#SerialTable tr:first").after(myRow);
            msg.success('Ingresado..!', 'Listo!');
        }
    }
}

function DeleteCompraInicial()
{
    $.confirm({
        confirm: function(){
            $.ajax({
                type: 'POST',
                url: 'admin/compras/delete',
                data: { id: $("input[name='compra_id']").val() },
                success: function (data) {
                    if (data == 'success')
                    {
                        f_com_op();
                        msg.success('Compra Eliminada..!', 'Listo!');
                    }
                    else
                    {
                        msg.warning(data, 'Advertencia!');
                    }
                },
                error: function(errors){
                    msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
                }
            });
        }
    });
}

function FinalizarCompraInicial()
{
    $.ajax({
        type: 'POST',
        url: 'admin/compras/finalizar',
        data: { compra_id: $("input[name='compra_id']").val(),nota: $("input[name='nota']").val() },
        success: function (data) {
            if (data == 'success')
            {
                f_com_op();
                msg.success('Compra Finalizada..!', 'Listo!');
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function(errors){
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
        }
    });
}

function view_serial()
{
    $serial = $("input[name='serial']").val();
    $.ajax({
        type: "GET",
        url: "admin/compras/serial",
        data: {serial: $serial},
        contentType: 'application/x-www-form-urlencoded',
        success: function (data) {
            $('.modal-body').html(data);
            $('.modal-title').text('Seriales');
            $('.bs-modal').modal('show');
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    });
}

function  DeleteSerialCompra(element)
{
    var id  = $(element).attr('id');
    $.confirm({
        confirm: function(){
            series=$("input[name='serial']").val().replace(id,'');
            $("input[name='serial']").val(series);
            $(element).closest('tr').hide();
        }
    });
}

function _edit_producto() {

    $id  =  $("input[name='producto_id']").val();
    if ($id > 0)
    {
        $.ajax({
            type: "POST",
            url: "admin/productos/edit",
            data: {id: $id},
            contentType: 'application/x-www-form-urlencoded',
            success: function (data) {
                $('.modal-body').html(data);
                $('.modal-title').text( 'Editar Producto');
                $('.bs-modal').modal('show');
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
    };
};

function _add_producto () 
{
    $.get( "admin/productos/create", function( data ) {
        $('.modal-body').html(data);
        $('.modal-title').text( 'Crear ' + $('.dataTable').attr('title') );
        $('.bs-modal').modal('show');
    });
}
