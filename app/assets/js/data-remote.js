$(document).on('submit', 'form[data-remote]', function(e) {

    $('input[type=submit]', this).attr('disabled', 'disabled');


    if( $('input[type=checkbox]', this).is(':checked') ) 
    {
        $('input[type=checkbox]', this).val('1');
    }
    else
    {
        $('input[type=checkbox]', this).val('0');
    }

    var form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {

            if (data == 'success')
            {
                msg.success(form.data('success'), 'Listo!');
                $('.bs-modal').modal('hide');
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

    $('input[type=submit]', this).removeAttr('disabled');

    e.preventDefault();

});

// $(document).on('submit', 'form[data-remote-md]', function(e) {

//     $('input[type=submit]', this).attr('disabled', 'disabled');

//     var form = $(this);

//     $.ajax({  
//         type: form.attr('method'),
//         url: form.attr('action'),
//         data: form.serialize(),
//         success: function (data) {
            
//                 if (data.success == true)
//                 {
//                     msg.success(form.data('success'), 'Listo!');

//                     $("input[name='"+data.name_id+"']").val(data.id);

//                     $.get( data.view , function( data )     
//                     {
//                         $('.master-detail-body').html(data);
//                     });

//                     $('form .form-footer').hide();
//                 }
//                 else
//                 {
//                  msg.warning(data, 'Advertencia!');
//                 }
//             },
//                 error: function(errors){
//                 msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
//             }
//         });

//         $('input[type=submit]', this).removeAttr('disabled');

//         e.preventDefault();
// });

$(document).on('submit', 'form[data-remote-md]', function(e) {

    $('input[type=submit]', this).attr('disabled', 'disabled');

    var form = $(this);

    $.ajax({  
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {
            if (data.success == true)
            {
                msg.success(form.data('success'), 'Listo!');

                $("input[name='venta_id']").val(data.id);

                $("input[name='compra_id']").val(data.id);

                $('.master-detail-body').html(data.detalle);

                $('form .form-footer').hide();
            }
            else
            {
                msg.warning(data, 'Advertencia!');
            }
        },
        error: function(errors) {
            msg.error('Hubo un error, intentelo de nuevo', 'Advertencia!');
         }
    });

    $('input[type=submit]', this).removeAttr('disabled');

    e.preventDefault();
});

$(document).on('submit', 'form[data-remote-cat]', function(e) {

    $('input[type=submit]', this).attr('disabled', 'disabled');
    var nombre = $('input[name=nombre]' , this);
    var form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {

            if (data.success == true)
            {
                msg.success(form.data('success'), 'Listo!');
                $('.categorias-detail').html(data.lista);
                $('.select_'+data.model).html(data.select);

                if (data.model == 'categorias') 
                {
                    $.confirm({
                        text: "desea Ingresar Sub Categorias para la Categoria "+nombre.val()+"?",
                        confirm: function() {
                            new_sub_categoria();
                            $('.form-select-'+data.model).html(data.select);
                        }
                    });
                }

                nombre.val('');
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

$('input[type=submit]', this).removeAttr('disabled');

e.preventDefault();

});
