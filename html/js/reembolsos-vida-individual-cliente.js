//  function lista1(){

//     $.ajax({

//         url:"controller/reembolsos-clientes/controlador_reembolsos_cliente_vida_individual_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log(respuesta);

//         }
//     });
//  }

var table_listar_reembolsos_vida_individual;
function listar_reembolsos_cliente_vida_individual() {
  table_listar_reembolsos_vida_individual = $(
    "#tabla-listar-reembolsos-vida-individual"
  ).DataTable({
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
    ajax: "controller/reembolsos-clientes/controlador_reembolsos_cliente_vida_individual_listar.php",
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

$("#txt_documento_reembolso").change(function () {
  var documento = this.files[0];

  // Tamaño correcto en bytes (25MB reales)
  var maxSizeMB = 25;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;
  /*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  if (documento["type"] != "application/pdf") {
    $("#txt_documento_reembolso").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $("#txt_documento_reembolso").val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

/*********************************
 ABRI MODAL REGISTRO DE FACTURA CLIENTE
 *********************************/
function AbrirModalRegistro() {
  $("#modalAgregarReembolso").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarReembolso").modal("show");
  LimpiarRegistro();
}

function LimpiarRegistro() {
  $("#txt_idBayer").val("");
  $("#txt_contrato_aplicar").val("");
  $("#txt_nombre_paciente").val("");
  $("#txt_fecha_atencion").val("");
  $("#txt_valor_presentado").val("");
  $("#txt_lugar_atencion").val("");
  $("#txt_diagnostico").val("");
  $("#txt_documento_reembolso").val("");
}

/*=============================================
  RECARGAR ETIQUETAS LISTAR OBSERVACIONES
  =============================================*/
function listarDatosReembolso() {
  var listaDatosReembolso = [];

  var nombre_paciente = $(".nombre_paciente");
  var fecha_atencion = $(".fecha_atencion");
  var valor_presentado = $(".valor_presentado");
  var lugar_atencion = $(".lugar_atencion");
  var diagnostico = $(".diagnostico_reembolso");

  for (var i = 0; i < nombre_paciente.length; i++) {
    var diagnostico_valor = $(diagnostico[i])
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();
    var nombre_paciente_valor = $(nombre_paciente[i])
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();
    var lugar_atencion_valor = $(lugar_atencion[i])
      .val()
      .replace(/(\r\n|\n|\r|\t)/gm, " ")
      .toUpperCase();

    listaDatosReembolso.push({
      nombre_paciente: nombre_paciente_valor,
      fecha_atencion: $(fecha_atencion[i]).val(),
      valor_presentado: $(valor_presentado[i]).val(),
      lugar_atencion: lugar_atencion_valor,
      diagnostico: diagnostico_valor,
    });
  }

  $("#listaDatosReembolso").val(JSON.stringify(listaDatosReembolso));
}

/*=============================================
  ACTUALIZAR LISTADO DATOS REEMBOLSO
  =============================================*/

$(".nuevoDatosReembolso").on("keyup", "input.nombre_paciente", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on("keyup", "input.fecha_atencion", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on("keyup", "input.valor_presentado", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on("keyup", "input.lugar_atencion", function () {
  listarDatosReembolso();
});

$(".nuevoDatosReembolso").on(
  "keyup",
  "textarea.diagnostico_reembolso",
  function () {
    listarDatosReembolso();
  }
);

/*********************************
   REGISTRAR UN NUEVO REEMBOLSO
   *********************************/
function Registrar_Reembolso() {
  var idBayer = $("#txt_idBayer").val().toUpperCase();
  var listaDatosReembolso = $("#listaDatosReembolso").val();
  var documento;

  var cont = 0;

  if (listaDatosReembolso.length > 0) {
    var data = JSON.parse(listaDatosReembolso);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var nombre_paciente = data[i]["nombre_paciente"];
        var fecha_atencion = data[i]["fecha_atencion"];
        var valor_presentado = data[i]["valor_presentado"];
        var lugar_atencion = data[i]["lugar_atencion"];
        var diagnostico = data[i]["diagnostico"];

        if (
          nombre_paciente.length == 0 ||
          fecha_atencion.length == 0 ||
          valor_presentado.length == 0 ||
          lugar_atencion.length == 0 ||
          diagnostico.length == 0
        ) {
          cont++;
        }
      }
    }
  }

  if (idBayer.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un contrato valido",
      "warning"
    );
  }

  if (listaDatosReembolso.length == 0 || cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios para el Reembolso",
      "warning"
    );
  }

  if ($("#txt_documento_reembolso").val().length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Seleccione un documento a subir",
      "warning"
    );
  }

  var archivo = $("#txt_documento_reembolso").val();
  var extension = archivo.split(".").pop();
  documento = $("#txt_documento_reembolso")[0].files[0];

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("listaDatosReembolso", listaDatosReembolso);
  datos.append("extension", extension);
  datos.append("documento", documento);

  $.ajax({
    url: "controller/reembolsos-clientes/controlador_reembolso_vida_individual_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nuevo Reembolso Registrado",
          "success"
        ).then((value) => {
          $("#modalAgregarReembolso").modal("hide");
          table_listar_reembolsos_vida_individual.ajax.reload();
        });
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
    },
  });
}

/*=============================================
  LISTAR CONTRATOS EXISTENTES
  =============================================*/

$(".btnListarContratos").click(function () {
  $("#modalListarContratosClientes").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modalListarContratosClientes").modal("show");
  table_listar_contratos_cliente.ajax.reload();
});

var table_listar_contratos_cliente;
function listar_contratos_para_seleccionar() {
  var f = new Date();
  fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

  var fecha_actual = $("#txt_fecha_siniestro").val();

  if (fecha_actual == "") {
    fecha_envio = fecha;
  } else {
    fecha_envio = fecha_actual;
  }

  table_listar_contratos_cliente = $(
    "#table_listar_contratos_cliente"
  ).DataTable({
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
    ajax:
      "controller/contratos-clientes/controlador_contrato_cliente_vida_individual_listar_seleccionar.php?fecha=" +
      fecha_envio,
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
      $($(nRow).find("td")[4]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

$("#table_listar_contratos_cliente").on(
  "click",
  ".btnSeleccionarContrato",
  function () {
    var idCliente = $(this).attr("idCliente");
    var numeroContrato = $(this).attr("numeroContrato");

    $("#txt_idBayer").val(idCliente);
    $("#txt_contrato_aplicar").val(numeroContrato);

    $("#modalListarContratosClientes").modal("hide");
  }
);
