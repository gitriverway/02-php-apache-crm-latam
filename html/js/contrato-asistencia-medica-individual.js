/*********************************
 CARGAR LISTA DE CONTRATOS ASIGNADOS EN TABLA
 *********************************/
//  function lista1(){

//     $.ajax({

//         url:"controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log(respuesta);

//         }
//     });
//  }

if (window.matchMedia("(max-width:767px)").matches) {
  $("#tabla-contrato-cliente").removeClass("nowrap");
  $("#tabla-contrato-cliente").addClass("dt-responsive");
} else {
  $("#tabla-contrato-cliente").removeClass("dt-responsive");
  $("#tabla-contrato-cliente").addClass("nowrap");
}

var table;
function listar_contrato_cliente() {
  table = $("#tabla-contrato-cliente").DataTable({
    scrollX: true,
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    pageLength: 10,
    destroy: true,
    async: false,
    processing: true,
    ajax: "controller/contratos-clientes/controlador_contrato_cliente_asistencia_medica_individual_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 14; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });
}

$("#tabla-contrato-cliente").on("click", ".btnVerDocumento", function () {
  var documentoRuta = $(this).attr("ruta");
  window.open(documentoRuta, "Cedula", "width=1024,height=1024");
});
