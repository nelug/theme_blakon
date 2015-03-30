<script>

$(document).ready(function()
{
    proccess_table('Proveedores');

    $('#example').dataTable({
        "aoColumnDefs": [
            {"sClass": "widthM",              "sTitle": "Nombre",       "aTargets": [0]},
            {"sClass": "widthL",              "sTitle": "Direccion",    "aTargets": [1]},
            {"sClass": "align_right widthS",  "sTitle": "Telefono",     "aTargets": [2]},
            {"sClass": "widthM",              "sTitle": "nit",          "aTargets": [3]},
        ],

        "fnDrawCallback": function( oSettings ) {
            $( ".DTTT" ).html("");
            $( ".DTTT" ).append( '<button id="_create" class="btn btngrey">New</button>' );
            $( ".DTTT" ).append( '<button id="_edit" class="btn btngrey btn_edit" disabled>Edit</button>' );
            $( ".DTTT" ).append( '<button id="_delete" class="btn btngrey btn_edit" disabled>Delete</button>' );
        },

        "bJQueryUI": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "user/datatables/proveedores"
    });

});

</script>