// function lista1(){

//     $.ajax({
//         url: "controller/bloqueo_ip/controlador_bloqueo_ip_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         async : false,
//         success: function (respuesta) {
//           console.log(respuesta);
//         }
//       })

// }

var table_bloqueo_ip;
function listar_bloqueo_ip(){
    table_bloqueo_ip = $('#tabla_bloqueo_ip').DataTable( {
        "ordering":false,   
        "bLengthChange":true,
        "searching": { "regex": false },
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "pageLength": 10,
        "destroy":true,
        "async": false ,
        "processing": true,
        "searchPanes": {
          layout: "columns-4",
          cascadePanes: true,
          dtOpts: {
              dom: "tp",
              paging: true,
              pagingType: 'numbers',
              searching: false
          }
      },
      "dom": "Plfrtip",
      "columnDefs": [
          {
              searchPanes: {
                  show: true
              },
              targets: [1,2,3,4]
          }
      ],
        "ajax": "controller/bloqueo_ip/controlador_bloqueo_ip_listar.php",
        "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $($(nRow).find("td")[0]).css('text-align', 'center' );
        $($(nRow).find("td")[1]).css('text-align', 'center' );
        $($(nRow).find("td")[2]).css('text-align', 'center' );
        $($(nRow).find("td")[3]).css('text-align', 'center' );
        $($(nRow).find("td")[4]).css('text-align', 'center' );
        },
        "language":idioma_espanol
    } );
}


/*=============================================
ACTIVAR BLOQUEO IP
=============================================*/
$("#tabla_bloqueo_ip").on("click", ".btnEstadoBloqueoIp", function(){
   
    var idBloqueoIp = $(this).attr("idBloqueoIp");
    var estatus = $(this).attr("estadoBloqueo");

    Modificar_Estatus(idBloqueoIp,estatus);
 })
 
 function Modificar_Estatus(idBloqueoIp,estatus){

    var mensaje = "";

    if (estatus == "NO") {
        mensaje = "HABILITADO";
    } else {
        mensaje = "BLOQUEADO";
    }
 
    var datos = new FormData();
     datos.append("activarId", idBloqueoIp);
      datos.append("activarEstatus", estatus);
 
    $.ajax({
 
        url:"controller/bloqueo_ip/controlador_modificar_estatus_bloqueo_ip.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            if(respuesta>0){
                var statusText = t('messages.ip_address_status', 'IP Address has been {status} successfully').replace('{status}', mensaje.toLowerCase());
                Swal.fire(t('messages.confirmation', 'Confirmation Message'), statusText, "success")            
                .then ( ( value ) =>  {
                    table_bloqueo_ip.ajax.reload();
                }); 
            }
 
        }
    });
 
 }