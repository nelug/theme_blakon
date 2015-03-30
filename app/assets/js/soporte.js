$(function() {

    $(document).on('click', '#f_soporte', function(){ f_soporte(this); });

});


function f_soporte() {

    $.get( "user/soporte/create", function( data ) {
        $('.modal-body').html(data);
        $('.modal-title').text('Ingresar soporte');
        $('.bs-modal').modal('show');
    });
}




// $(document).on('click', '.master-detail tr a', function(e) {

//     var id     = $(this).attr("id");
//     var url    = $(this).attr("href");
//     var action = $(this).attr("action");

//     if (action == 'edit')
//     {
//         $.ajax({
//             type: "POST",
//             url: url,
//             data: {id: id},
//             success: function (data) {
//                 $(".forms").html(data);
//             },
//             error: function (request, status, error) {
//                 alert(request.responseText);
//             }
//         });
//     }

//     else
//     {
//         $(this).closest('tr').hide();
//         alert("delete");
//     }

//     e.preventDefault();
// });

$(document).on('submit', 'form[data-remote-md2]', function(e) {

    $('input[type=submit]', this).attr('disabled', 'disabled');

    var form = $(this);

    $.ajax({
        type: form.attr('method'),
        url: form.attr('action'),
        data: form.serialize(),
        success: function (data) {

            if (data.success == true)
            {
                msg.success('Ingresado Exitosamente', 'Listo!');
                $('.master-detail').html(data.table);
                form.reset();
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
