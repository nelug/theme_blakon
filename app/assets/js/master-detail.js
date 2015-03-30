$(function() {
    $(document).on('click', '#_add_producto_md', function() { _add_producto_md(this);});
    $(document).on('click', '#md-search',            function() { md_search(this);  });
    $(document).on('enter', '#search_producto', function(e){ search_producto(e, this); });
});

function _add_producto_md()
{
    codigo = $('.dataTable tbody .row_selected td:first-child').text();
    $("#search_producto").val(codigo);
    $(".dt-container").hide();
    search_producto_dt();
}

function search_producto(e, element)
{   
    $.ajax({
        type: 'POST',
        url: 'user/productos/find',
        data: {codigo:$(element).val()},
        success: function (data) {
            if (data.success == true) {
                $("input[name='producto_id']").val(data.id);
                $("input[name='cantidad']").focus();
                $('.descripcion').html(data.descripcion);
                $('.precio-publico').html(data.p_publico);
                $('.precio-costo').html(data.p_costo);
                $('.existencia').html(data.existencia);
            }
            else
            {
                msg.warning('El codigo que ingreso no se encuentra en la base de datos', 'Advertencia!');
            }
        },
        error: function(errors){
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
        }
    });

    e.preventDefault();
};

function search_producto_dt()
{   
	element = $("#search_producto");
    $.ajax({
        type: 'POST',
        url: 'user/productos/find',
        data: {codigo:$(element).val()},
        success: function (data) {
            if (data.success == true) {
                $("input[name='producto_id']").val(data.id);
                $("input[name='cantidad']").focus();
                $('.descripcion').html(data.descripcion);
                $('.precio-publico').html(data.p_publico);
                $('.precio-costo').html(data.p_costo);
                $('.existencia').html(data.existencia);
            }
            else
            {
                msg.warning('El codigo que ingreso no se encuentra en la base de datos', 'Advertencia!');
            }
        },
        error: function(errors){
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
        }
    });
};
   
function DeleteDetalle(element) {
    var id  = $(element).attr('id');
    var url = $(element).attr('href');

    $.confirm({
        confirm: function(){
            $.ajax({
                type: 'POST',
                url: url,
                data: { id: id },
                success: function (data) {
                    if (data == "success")
                    {
                        msg.success('Eliminado', 'Listo!');
                        $(element).closest('tr').hide();
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

function md_search()
{
    $.get( "user/datatables/md_search", function( data ) 
    {
       makeTable(data, '', 'Inventario');
       $('#iSearch').focus();
    });
}
