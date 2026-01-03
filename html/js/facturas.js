/*********************************
 CARGAR LISTA DE EMPLEADO EN TABLA
 *********************************/
//  function lista1(){
//     $.ajax({

//         url:"controller/facturas-clientes/controlador_factura_cliente_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log("respuesta",respuesta);

//         }
//     });
//  }
var table;
function listar_factura_cliente() {
  table = $("#tabla-factura-cliente").DataTable({
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
    ajax: "controller/facturas/controlador_factura_cliente_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
      $($(nRow).find("td")[5]).css("text-align", "center");
      $($(nRow).find("td")[6]).css("text-align", "center");
      $($(nRow).find("td")[7]).css("text-align", "center");
      $($(nRow).find("td")[8]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}
/*********************************
 ABRI MODAL REGISTRO DE FACTURA CLIENTE
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarFactura").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarFactura").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_documento").val("");
  $("#txt_nombre").val("");
  $("#txt_numero_factura").val("");
  $("#txt_fecha_emision").val("");
  $("#txt_valor").val("");
  $("#cbm_forma_pago").val("").change();
  $("#txt_factura_documento").val("");
}

$("#txt_factura_documento").change(function () {
  var documento = this.files[0];

  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (documento["type"] != "application/pdf") {
    $("#txt_factura_documento").val("");

    Swal.fire({
      icon: "error",
      title: t('messages.error_uploading_document', 'Error uploading document'),
      text: t('messages.document_must_be_pdf', 'The document must be in PDF format!'),
      confirmButtonText: t('messages.close', 'Close'),
    });
  } else if (documento["size"] > 25000000) {
    $("#txt_factura_documento").val("");

    Swal.fire({
      icon: "error",
      title: t('messages.error_uploading_document', 'Error uploading document'),
      text: t('messages.document_size_exceeded', 'The document must not exceed 50MB!'),
      confirmButtonText: t('messages.close', 'Close'),
    });
  }
});

function agregarNuevaFactura() {
  var cedula = $("#txt_documento").val();
  var nombre = $("#txt_nombre").val();
  var numero_factura = $("#txt_numero_factura").val();
  var fecha_emision = $("#txt_fecha_emision").val();
  var valor_factura = $("#txt_valor").val();
  var forma_pago = $("#cbm_forma_pago").val();
  var factura_documento;

  if (
    cedula.length == 0 ||
    nombre.length == 0 ||
    numero_factura.length == 0 ||
    fecha_emision.length == 0 ||
    valor_factura.length == 0 ||
    forma_pago.length == 0
  ) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_empty_fields', 'Fill in the empty fields'),
      "warning"
    );
  }

  if ($("#txt_factura_documento").val() == "") {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.no_document_to_upload', 'No document to upload'),
      "warning"
    );
  }

  var archivo = $("#txt_factura_documento").val();
  var extension = archivo.split(".").pop();
  factura_documento = $("#txt_factura_documento")[0].files[0];

  var datos = new FormData();

  datos.append("cedula", cedula);
  datos.append("nombre", nombre);
  datos.append("numero_factura", numero_factura);
  datos.append("fecha_emision", fecha_emision);
  datos.append("valor_factura", valor_factura);
  datos.append("forma_pago", forma_pago);
  datos.append("factura_documento", factura_documento);
  datos.append("extension", extension);

  $.ajax({
    url: "controller/facturas/controlador_factura_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#modalAgregarFactura").modal("hide");
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.invoice_registered', 'Data correctly, New Invoice Registered'),
          "success"
        ).then((value) => {
          table.ajax.reload();
        });
      } else {
        Swal.fire(
          t('messages.error', 'Error'),
          t('messages.could_not_complete_registration', 'Sorry, could not complete registration'),
          "error"
        );
      }
    },
  });
}

$("#tabla-factura-cliente").on(
  "click",
  ".btnImprimirFacturaCliente",
  function () {
    var facturaRuta = $(this).attr("facturaRuta");
    window.open(
      facturaRuta,
      "Cotizacion Planes Salud",
      "width=1024,height=1024"
    );
  }
);

$("#tabla-factura-cliente").on(
  "click",
  ".btnEliminarFacturaCliente",
  function () {
    var idFactura = $(this).attr("idFactura");
    var facturaRuta = $(this).attr("facturaRuta");

    Swal.fire({
      title: "Estas Seguro?",
      text: "No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminarlo!",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminar_factura_cliente(idFactura, facturaRuta);

        Swal.fire("Eliminado!", "La Factura ha sido eliminado.", "success");
      }
    });
  }
);

function eliminar_factura_cliente(idFactura, facturaRuta) {
  var datos = new FormData();

  datos.append("idFactura", idFactura);
  datos.append("facturaRuta", facturaRuta);

  $.ajax({
    url: "controller/facturas/controlador_factura_eliminar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      table.ajax.reload();
      return respuesta;
      // console.log(respuesta);
    },
  });
}
