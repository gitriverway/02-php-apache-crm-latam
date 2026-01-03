// function lista1(){

//     $.ajax({
//         url: "controller/clientes/controlador_cliente_listar_asistencia_medica_individual.php",
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

function fecha_actual() {
  var fecha_actual_obervacion;

  $.ajax({
    url: "controller/controlador_fecha_zona_horario.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    success: function (respuesta) {
      fecha_actual_obervacion = respuesta;
    },
  });
  return fecha_actual_obervacion;
}

function getEdad(dateString) {
  let hoy = new Date();
  let fechaNacimiento = new Date(dateString);
  let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
  let diferenciaMeses = hoy.getMonth() - fechaNacimiento.getMonth();
  if (
    diferenciaMeses < 0 ||
    (diferenciaMeses === 0 && hoy.getDate() < fechaNacimiento.getDate())
  ) {
    edad--;
  }
  return edad;
}

function getEdadAno(dateString) {
  let hoy = new Date();
  let edad = hoy.getFullYear() - dateString;

  if (edad < 0) {
    edad = 0;
  }

  return edad;
}

if (window.matchMedia("(max-width:767px)").matches) {
  $("#tabla_cliente").removeClass("nowrap");
  $("#tabla_cliente").addClass("dt-responsive");
} else {
  $("#tabla_cliente").removeClass("dt-responsive");
  $("#tabla_cliente").addClass("nowrap");
}

var tabla_cliente;
function listar_cliente() {
  tabla_cliente = $("#tabla_cliente").DataTable({
    scrollX: true,
    ordering: false,
    destroy: true,
    processing: true,
    //     // "dom": "Plfrtip",
    dom: "PBfrtip", // 'P' para SearchPanes
    select: true, // Activa Select
    ajax: "controller/clientes/controlador_cliente_listar_asistencia_medica_individual.php",
    searchPanes: {
      cascadePanes: true,
      layout: "columns-6",
      dtOpts: {
        paging: true,
        pagingType: "numbers",
        searching: false,
      },
    },
    columnDefs: [
      {
        targets: [1, 3, 8, 12, 24, 25],
        searchPanes: { show: true },
      },
      {
        targets: [
          2, 4, 5, 6, 7, 9, 10, 11, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23,
        ],
        searchPanes: { show: false },
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 25; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });
}

var table_vendedor;
function listar_vendedores() {
  table_vendedor = $("#tabla_lista_vendedores").DataTable({
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
    ajax: "controller/usuarios/controlador_asignar_vendedor_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

var table_documentos;
function listar_documentos(idCliente) {
  table_documentos = $("#tabla_lista_contratos").DataTable({
    ordering: false,
    bLengthChange: true,
    searching: { regex: false },
    lengthMenu: [
      [5, 10, 25, 50, 100, -1],
      [5, 10, 25, 50, 100, "All"],
    ],
    pageLength: 5,
    destroy: true,
    async: false,
    processing: true,
    ajax:
      "controller/contratos-clientes/controlador_contrato_listar_documento.php?idCliente=" +
      idCliente,
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
/*********************************
 ABRI MODAL LISTAR CONTRATOS
 *********************************/
$("#tabla_cliente").on("click", ".btnListaContratos", function () {
  var idCliente = $(this).attr("idCliente");

  $("#modal_listar_contratos").modal({ backdrop: "static", keyboard: false });
  $("#modal_listar_contratos").modal("show");
  listar_documentos(idCliente);
});

/*********************************
 ABRI MODAL LISTAR CONTRATOS EDITAR
 *********************************/
$("#cardDocumento").on("click", ".btnListaContratos", function () {
  var idCliente = $("#txt_idBayer").val();

  $("#modal_listar_contratos").modal({ backdrop: "static", keyboard: false });
  $("#modal_listar_contratos").modal("show");
  listar_documentos(idCliente);
});

$("#tabla_lista_contratos").on("click", ".btnImprimirDocumento", function () {
  var documentoRuta = $(this).attr("documentoRuta");
  window.open(documentoRuta, "Documento Contrato", "width=1024,height=1024");
});

$(".listaAdicional").on("click", ".btnVerDocumentoCondiciones", function () {
  var documentoRuta = $(this).attr("ruta");
  window.open(
    documentoRuta,
    "Documento Condiciones Renovacion",
    "width=1024,height=1024"
  );
});

$("#tabla_lista_contratos").on(
  "click",
  ".btnEliminarDocumentoEmision",
  function () {
    var idCliente = $(this).attr("idCliente");
    var idDocumentoEmision = $(this).attr("idDocumentoEmision");
    var carpetaDocumento = $(this).attr("carpetaDocumento");
    var documentoRuta = $(this).attr("documentoRuta");

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
        eliminar_documento_emision(
          idCliente,
          idDocumentoEmision,
          carpetaDocumento,
          documentoRuta
        );
      }
    });
  }
);

function eliminar_documento_emision(
  idCliente,
  idDocumentoEmision,
  carpetaDocumento,
  documentoRuta
) {
  var datos = new FormData();
  datos.append("idCliente", idCliente);
  datos.append("idDocumentoEmision", idDocumentoEmision);
  datos.append("carpetaDocumento", carpetaDocumento);
  datos.append("documentoRuta", documentoRuta);

  $.ajax({
    url: "controller/contratos-clientes/controlador_documento_emision_eliminar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == 1) {
        Swal.fire("Eliminado!", "El Documento ha sido eliminado.", "success");
        table_documentos.ajax.reload();
      } else {
        Swal.fire("Oops...!", "El Documento no pudo ser eliminado.", "error");
      }
      return respuesta;
    },
  });
}

/*********************************
 ABRI MODAL ASIGNAR VENDEDOR
 *********************************/
$("#tabla_cliente").on("click", ".btnListaVendedor", function () {
  var idCliente = $(this).attr("idCliente");
  $("#txt_idBayer").val(idCliente);

  $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
  $("#modal_asignar_vendedor").modal("show");
});

$("#tabla_lista_vendedores").on("click", ".btnAsignarVendedor", function () {
  var idCliente = $("#txt_idBayer").val();
  var idEmpleado = $(this).attr("idEmpleado");

  var datos = new FormData();
  datos.append("idCliente", idCliente);
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/clientes/controlador_modificar_vendedor_asignado_a_cliente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "El vendedor a sido asignado",
          "success"
        ).then((value) => {
          $("#modal_asignar_vendedor").modal("hide");
          tabla_cliente.ajax.reload();
        });
      }
    },
  });
});

/*********************************
EDITAR BAYER PERSONA
*********************************/
$("#tabla_cliente").on("click", ".btnBayerPersona", function () {
  var idCliente = $(this).attr("idCliente");
  window.location =
    "index.php?ruta=editar-cliente-asistencia-medica-individual&idCliente=" +
    idCliente;
});

/*********************************
BLOQUE PARA EDITAR CLIENTE
*********************************/
/*********************************
LISTAR COMBO CATEGORIA
*********************************/
function listar_combo_categoria() {
  $.ajax({
    url: "controller/categorias/controlador_combo_categoria_individual_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";
      if (data.length > 0) {
        cadena += "<option value=''>Seleccione..</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option  value='" +
            data[i]["categoria_id"] +
            "'>" +
            data[i]["categoria_nombre"] +
            "</option>";
        }
        // cadena += "<option value='0'>OTROS</option>";
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_categoria").html(cadena);
    },
  });
}

/*********************************
LISTAR COMBO ASEGURADORAS
*********************************/
function listar_combo_aseguradora() {
  $.ajax({
    url: "controller/proveedores/controlador_combo_proveedor_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";
      if (data.length > 0) {
        cadena += "<option value=''>Seleccione..</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option  value='" +
            data[i]["proveedor_id"] +
            "'>" +
            data[i]["proveedor_descripcion"] +
            "</option>";
        }
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_proveedor").html(cadena);
    },
  });
}

/*********************************
LISTAR COMBO PROVINCIAS
*********************************/
function listar_combo_provincia() {
  $.ajax({
    url: "controller/provincias/controlador_combo_provincia_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";
      if (data.length > 0) {
        cadena += "<option value='0'>Seleccione..</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option value='" +
            data[i]["provincia_id"] +
            "'>" +
            data[i]["provincia_descripcion"] +
            "</option>";
        }
      } else {
        cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
      }
      $(".cbm_provincia").html(cadena);
    },
  });
}

// $("#cbm_proveedor").change( function(){
//   $("#txt_planes").val("");
// }
// )

$("#cbm_categoria").change(function () {
  if ($(this).val() == "0") {
    $("#txt_nuevo_categoria").val("");
    $("#txt_nuevo_categoria").prop("readOnly", false);
  } else {
    $("#txt_nuevo_categoria").val("");
    $("#txt_nuevo_categoria").prop("readOnly", true);
  }
});

/*=============================================
  ACTUALIZAR LISTADO FAMILIARES
  =============================================*/

// $(".listaAdicional").on("change", "select.tipoFamiliar", function () {
//   listarFamiliares();
// })

// $(".listaAdicional").on("change", "input.nombreFamiliar", function () {
//   listarFamiliares();
// })

// $(".listaAdicional").on("keyup", "input.nombreFamiliar", function () {
//   listarFamiliares();
// })

// $(".listaAdicional").on("change", "select.generoFamiliar", function () {
//   listarFamiliares();
// })

// $(".listaAdicional").on("change", "input.fecha_nacimiento_Familiar", function () {
//   listarFamiliares();
// })

// $(".listaAdicional").on("keyup", "input.deducibleFamiliar", function () {
//   listarFamiliares();
// })

/*=============================================
AGREGANDO FAMILIAR
=============================================*/

var numProspecto = 0;

$(".listaAdicional").on("click", "button.btnAgregarDependiente", function () {
  numProspecto++;
  var estado = "";
  var estado1 = "";

  if (numProspecto > 1) {
    estado = "d-md-none";
    estado1 = "d-none";
  } else {
    estado = "";
    estado1 = "";
  }

  // $(this).parent().parent().find(".idListaDependiente").css({"color": "red", "border": "2px solid red"});

  let valor = $(this).parent().parent().find(".idListaDependiente").val();

  // $(".nuevoDependiente").append(

  $(this)
    .parent()
    .parent()
    .find(".nuevoDependiente")
    .append(
      '<div class="col-12 my-1">' +
        '<div class="row gridMiembroFamiliares">' +
        "<!-- Parentesco -->" +
        '<div class="col-6 col-md-1 order-md-1 my-1 ' +
        estado +
        ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
        numProspecto +
        '" style="padding-right:0px">' +
        "<label>Parentesco</label>" +
        "</div>" +
        '<div class="col-6 col-md-1 order-md-7 my-1" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<select class="form-control tipoFamiliar' +
        valor +
        '" id="tipoFamiliar' +
        numProspecto +
        '" name="tipoFamiliar' +
        numProspecto +
        '" required>' +
        '<option value= "">Seleccione...</option>' +
        '<option value= "Titular">Titular</option>' +
        '<option value= "Conyuge">Conyuge</option>' +
        '<option value= "Hijo/a">Hijo/a</option>' +
        '<option value= "Otro">Otro</option>' +
        '<option value= "Familiar">Familiar</option>' +
        "</select>" +
        "</div>" +
        "</div>" +
        "<!-- Nombre -->" +
        '<div class="col-6 col-md-4 order-md-2 my-1 ' +
        estado +
        ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
        numProspecto +
        '">' +
        "<label>Nombre</label>" +
        "</div>" +
        '<div class="col-6 col-md-4 order-md-8 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosLetras nombreFamiliar' +
        valor +
        '" id="nombreFamiliar' +
        numProspecto +
        '" name="nombreFamiliar' +
        numProspecto +
        '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Genero -->" +
        '<div class="col-6 col-md-2 order-md-3 my-1 ' +
        estado +
        ' etiquetaGeneroFamiliar" id = "etiquetaGeneroFamiliar' +
        numProspecto +
        '">' +
        "<label>Genero</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-9 my-1">' +
        '<select class="form-control generoFamiliar' +
        valor +
        '" id="generoFamiliar' +
        numProspecto +
        '" name="generoFamiliar' +
        numProspecto +
        '" required>' +
        '<option value="">Seleccione...</option>' +
        '<option value="masculino">Masculino</option>' +
        '<option value="femenino">Femenino</option>' +
        "</select>" +
        "</div>" +
        "<!-- Fecha de Nacimiento -->" +
        '<div class="col-6 col-md-2 order-md-4 my-1 ' +
        estado +
        ' etiquetaFechaNacimiento" id = "etiquetaFechaNacimiento' +
        numProspecto +
        '" style="padding-left:0px">' +
        "<label>Fecha Nacimiento</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<input type="date" class="form-control fecha_nacimiento_Familiar' +
        valor +
        '" id="fecha_nacimiento_Familiar' +
        numProspecto +
        '" name="fecha_nacimiento_Familiar' +
        numProspecto +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Deducible -->" +
        '<div class="col-6 col-md-2 order-md-5 my-1 ' +
        estado +
        ' etiquetaDeducibleFamiliar" id = "etiquetaDeducibleFamiliar' +
        numProspecto +
        '">' +
        "<label>Deducible</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-11 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosDecimal deducibleFamiliar' +
        valor +
        '" id="deducibleFamiliar' +
        numProspecto +
        '" name="deducibleFamiliar' +
        numProspecto +
        '" placeholder="INGRESE DEDUCIBLE" autocomplete="off" value = "0"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Acciones -->" +
        '<div class="col-6 col-md-1 order-md-6 my-1 ' +
        estado1 +
        ' etiquetaAcciones" id = "etiquetaAcciones' +
        numProspecto +
        '" style="padding-left:0px">' +
        "<label></label>" +
        "</div>" +
        '<div class="col-12 col-md-1 order-md-12 my-1" style="padding-left:0px">' +
        '<button type="button" class="form-control btn btn-danger quitarDependiente idFamiliar="' +
        numProspecto +
        '"><i class="fa fa-times"></i></button>' +
        "</div>" +
        "</div>" +
        "</div>"
    );

  // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
  // $(".deducibleFamiliar").number(true, 2);
});

/*=============================================
RECARGAR ETIQUETAS LISTAR FAMILIAR
=============================================*/

function recargarEtiquetaslistarFamiliares() {
  var tipo = $(".etiquetaTipoFamiliar");

  var nombre = $(".etiquetaNombreFamiliar");

  var genero = $(".etiquetaGeneroFamiliar");

  var fecha_nacimiento = $(".etiquetaFechaNacimiento");

  var deducible = $(".etiquetaDeducibleFamiliar");

  var acciones = $(".etiquetaAcciones");

  for (var i = 0; i < tipo.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let nombre1 = $(nombre[i]).attr("id");
    let genero1 = $(genero[i]).attr("id");
    let fecha_nacimiento1 = $(fecha_nacimiento[i]).attr("id");
    let deducible1 = $(deducible[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + deducible1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + deducible1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + nombre1).addClass("d-md-none");
      $("#" + genero1).addClass("d-md-none");
      $("#" + fecha_nacimiento1).addClass("d-md-none");
      $("#" + deducible1).addClass("d-md-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
LISTAR DEPENDIENTE CONTRATOS
=============================================*/
function listarDependientesContrato() {
  var listaFamiliares = [];
  var id = $(".idDependiente");
  var lista_familiares = $(".listaFamiliares");
  var lista_vehiculos = $(".listaVehiculos");

  for (var i = 0; i < id.length; i++) {
    // console.log($(lista[i]).val());

    listaFamiliares.push({
      id: $(id[i]).val().trim(),
      lista_familiares: $(lista_familiares[i]).val(),
      lista_vehiculos: $(lista_vehiculos[i]).val(),
    });
  }

  $("#listaDependientesContrato").val(JSON.stringify(listaFamiliares));
  // console.log($("#listaDependientesContrato").val());
}

function listarFamiliares() {
  var lista = $(".nuevoDependiente");

  for (var j = 1; j <= lista.length; j++) {
    var listaFamiliares = [];

    var tipo = $(".tipoFamiliar" + j);

    var nombre = $(".nombreFamiliar" + j);

    var genero = $(".generoFamiliar" + j);

    var fecha_nacimiento = $(".fecha_nacimiento_Familiar" + j);

    var valor_deducible = $(".deducibleFamiliar" + j);

    for (var i = 0; i < tipo.length; i++) {
      listaFamiliares.push({
        tipo: $(tipo[i]).val().trim(),
        nombre: $(nombre[i]).val().trim().toUpperCase(),
        genero: $(genero[i]).val(),
        fecha_nacimiento: $(fecha_nacimiento[i]).val(),
        edad: getEdad($(fecha_nacimiento[i]).val()),
        valor_deducible: $(valor_deducible[i]).val(),
      });
    }

    $("#listaFamiliares" + j).val(JSON.stringify(listaFamiliares));

    // console.log($("#listaFamiliares"+j).val());
  }
}

/*=============================================
QUITAR FAMILIAR
=============================================*/

var idQuitarFamiliar = [];

localStorage.removeItem("quitarDependiente");

$(".listaAdicional").on("click", "button.quitarDependiente", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idFamiliar = $(this).attr("idFamiliar");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarDependiente") == null) {
    idQuitarFamiliar = [];
  } else {
    idQuitarFamiliar.concat(localStorage.getItem("quitarDependiente"));
  }

  idQuitarFamiliar.push({
    idFamiliar: idFamiliar,
  });

  localStorage.setItem("quitarDependiente", JSON.stringify(idQuitarFamiliar));

  numProspecto--;

  if ($(".nuevoDependiente").children().length == 0) {
    $("#listaFamiliares").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarFamiliares();
    recargarEtiquetaslistarFamiliares();
  }
});

function listarContratos() {
  var listaContratos = [];

  var id = $(".idContrato");

  var estado_pago = $(".chkEstadoPago");

  var numero_contrato = $(".txt_numero_contrato");

  var fecha_inicio_contrato = $(".txt_fecha_inicio_contrato");

  var fecha_fin_contrato = $(".txt_fecha_fin_contrato");

  for (var i = 0; i < id.length; i++) {
    if ($(estado_pago[i]).is(":checked")) {
      estado = 1;
    } else {
      estado = 0;
    }

    listaContratos.push({
      id: $(id[i]).val().trim(),
      estado_pago: estado,
      numero_contrato: $(numero_contrato[i]).val().trim(),
      fecha_inicio_contrato: $(fecha_inicio_contrato[i]).val(),
      fecha_fin_contrato: $(fecha_fin_contrato[i]).val(),
    });
  }

  $("#listaContratos").val(JSON.stringify(listaContratos));
}

/*=============================================
AGREGANDO OBSERVACION
=============================================*/

$(".btnAgregarObservacion").click(function () {
  $("#modalAgregarObservacion").modal({ backdrop: "static", keyboard: false });
  $("#modalAgregarObservacion").modal("show");
  $("#txt_observacion").val("");
});

var numObservacion = 0;

function agregarNuevaObservacion() {
  var observacion = $("#txt_observacion").val();
  if (observacion.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene la observaci&oacute;n",
      "warning"
    );
  }
  numObservacion++;

  var estado = "";
  var estado1 = "";

  if (numObservacion > 1) {
    estado = "d-md-none";
    estado1 = "d-none";
  } else {
    estado = "";
    estado1 = "";
  }

  let formatted_date = fecha_actual();

  $(".nuevaObservacion").append(
    '<div class="col-12 my-1">' +
      '<div class="row">' +
      "<!-- Fecha de Registro -->" +
      '<div class="col-6 col-md-4 order-md-1 my-1 ' +
      estado +
      ' etiquetaFechaObservacion" id="etiquetaFechaObservacion' +
      numObservacion +
      '" style="padding-right:0px">' +
      "<label>Fecha Registro</label>" +
      "</div>" +
      '<div class="col-6 col-md-4 order-md-4 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<label class="fecha_registro" id="fecha_registro' +
      numObservacion +
      '" name="fecha_registro' +
      numObservacion +
      '">' +
      formatted_date +
      "</label>" +
      "</div>" +
      "</div>" +
      "<!-- Observacion -->" +
      '<div class="col-6 col-md-4 order-md-2 my-1 ' +
      estado +
      ' etiquetaDescripcionObservacion" id="etiquetaDescripcionObservacion' +
      numObservacion +
      '">' +
      "<label>Observaci&oacute;n</label>" +
      "</div>" +
      '<div class="col-6 col-md-4 order-md-5 my-1">' +
      '<label class="observacion" id="observacion' +
      numObservacion +
      '" name="observacion' +
      numObservacion +
      '">' +
      observacion +
      "</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-3 my-1 ' +
      estado1 +
      ' etiquetaAccionesObservacion" id ="etiquetaAccionesObservacion' +
      numObservacion +
      '">' +
      "<label></label>" +
      "</div>" +
      '<div class="col-12 col-md-2 order-md-6 my-1">' +
      '<button type="button" class="form-control btn btn-danger btn-xs quitarObservacion idObservacion="' +
      numObservacion +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );

  $("#txt_observacion").val("");
  listarObservaciones();
  $("#modalAgregarObservacion").modal("hide");
}

/*=============================================
RECARGAR ETIQUETAS LISTAR OBRSERVACION
=============================================*/

function recargarEtiquetaslistarObservaciones() {
  var fecha = $(".etiquetaFechaObservacion");

  var descripcion = $(".etiquetaDescripcionObservacion");

  var acciones = $(".etiquetaAccionesObservacion");

  for (var i = 0; i < fecha.length; i++) {
    let fecha1 = $(fecha[i]).attr("id");
    let descripcion1 = $(descripcion[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + fecha1).removeClass("d-md-none");
      $("#" + descripcion1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + fecha1).removeClass("d-md-none");
      $("#" + descripcion1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + fecha1).addClass("d-md-none");
      $("#" + descripcion1).addClass("d-md-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
RECARGAR ETIQUETAS LISTAR OBSERVACIONES
=============================================*/
function listarObservaciones() {
  var listaObservaciones = [];

  var fecha_registro = $(".fecha_registro");

  var observacion = $(".observacion");

  for (var i = 0; i < fecha_registro.length; i++) {
    listaObservaciones.push({
      fecha_registro: $(fecha_registro[i]).text(),
      observacion: $(observacion[i]).text().trim(),
    });
  }

  $("#listaObservaciones").val(JSON.stringify(listaObservaciones));
}

/*=============================================
QUITAR OBSERVACION
=============================================*/

var idQuitarObservacion = [];

localStorage.removeItem("quitarObservacion");

$(".nuevaObservacion").on("click", "button.quitarObservacion", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idObservacion = $(this).attr("idObservacion");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarObservacion") == null) {
    idQuitarObservacion = [];
  } else {
    idQuitarObservacion.concat(localStorage.getItem("quitarObservacion"));
  }

  idQuitarObservacion.push({
    idObservacion: idObservacion,
  });

  localStorage.setItem(
    "quitarObservacion",
    JSON.stringify(idQuitarObservacion)
  );

  numProspecto--;

  if ($(".nuevaObservacion").children().length == 0) {
    $("#listaObservaciones").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarObservaciones();
    recargarEtiquetaslistarObservaciones();
  }
});

$(".listaAdicional").on(
  "click",
  "button.btnAgregarNuevaCondicionRenovacion",
  function (e) {
    numCondicionRequerida++;

    var estado = "";

    if (numCondicionRequerida > 1) {
      estado = "d-md-none";
    } else {
      estado = "";
    }

    // $(this).parent().parent().find(".idCondiciones").css({"color": "red", "border": "2px solid red"});

    let valor = $(this).parent().parent().find(".idCondiciones").val();

    // $(".condicionRenovacion").append(

    $(this)
      .parent()
      .parent()
      .find(".condicionRenovacion")
      .append(
        '<div class="col-12 my-1">' +
          '<div class="row gridCondiconesRenovacion">' +
          "<!-- Condiciones -->" +
          '<div class="my-1 col-12 col-md-6 order-md-1 ' +
          estado +
          '">' +
          "<label>FORMAS DE PAGO</label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-6 order-md-5">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras condicionRequerido' +
          valor +
          '" id="condicionRequerido' +
          numCondicionRequerida +
          '" name="condicionRequerido' +
          numCondicionRequerida +
          '" placeholder="CONDICION REQUERIDO" autocomplete="off" style="text-transform: uppercase"></input>' +
          "</div>" +
          "</div>" +
          "<!-- VALOR -->" +
          '<div class="my-1 col-12 col-md-4 order-md-2 ' +
          estado +
          '">' +
          "<label>VALOR USD</label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-4 order-md-6">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosDecimal valorRequerido' +
          valor +
          '" id="valorRequerido' +
          numCondicionRequerida +
          '" name="valorRequerido' +
          numCondicionRequerida +
          '" placeholder="VALOR REQUERIDO" autocomplete="off" style="text-transform: uppercase" value="0"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="my-1 col-12 col-md-2 order-md-3 ' +
          estado +
          '">' +
          "<label></label>" +
          "</div>" +
          '<div class="my-1 col-12 col-md-2 order-md-7">' +
          '<button type="button" class="form-control btn btn-danger quitarCondicionRenovacion" idDocumento="' +
          numCondicionRequerida +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );
  }
);

/*=============================================
    QUITAR CONDICION
    =============================================*/

var idQuitarDocumento = [];

localStorage.removeItem("quitarCondicionRenovacion");

$(".listaAdicional").on(
  "click",
  "button.quitarCondicionRenovacion",
  function () {
    // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
    $(this).parent().parent().parent().remove();

    var idDocumento = $(this).attr("idDocumento");

    /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

    if (localStorage.getItem("quitarCondicionRenovacion") == null) {
      idQuitarDocumento = [];
    } else {
      idQuitarDocumento.concat(
        localStorage.getItem("quitarCondicionRenovacion")
      );
    }

    idQuitarDocumento.push({
      idDocumento: idDocumento,
    });
  }
);

/*=============================================
LISTAR TODAS LAS CONDICIONES
=============================================*/
function listarTotalCondiciones() {
  var listaCondiciones = [];
  var id = $(".idDependiente");
  var lista_familiares = $(".listaCondicionesRenovacion");
  var condicion_envio = $(".condicionEnvio");
  var ruta_documento = $(".rutaDocumentoCondicionRenovacion");

  for (var i = 0; i < id.length; i++) {
    // console.log($(lista[i]).val());

    listaCondiciones.push({
      id: $(id[i]).val().trim(),
      lista_condiciones: $(lista_familiares[i]).val(),
      condicion_envio: $(condicion_envio[i]).val(),
      ruta_documento: $(ruta_documento[i]).val(),
    });
  }

  $("#listaTotalCondiciones").val(JSON.stringify(listaCondiciones));
  // console.log($("#listaTotalCondiciones").val());
}

/*=============================================
  LISTAR CONDCIONES
  =============================================*/

function listarCondiciones() {
  var lista = $(".condicionRenovacion");

  for (var j = 1; j <= lista.length; j++) {
    var listaCondicionesRenovacion = [];

    var condicion = $(".condicionRequerido" + j);
    var valor = $(".valorRequerido" + j);

    for (var i = 0; i < condicion.length; i++) {
      listaCondicionesRenovacion.push({
        condicion: $(condicion[i]).val().toUpperCase(),
        valor: $(valor[i]).val(),
      });
    }

    $("#listaCondicionesRenovacion" + j).val(
      JSON.stringify(listaCondicionesRenovacion)
    );

    // console.log($("#listaCondicionesRenovacion"+j).val());
  }
}

var num_condiciones_renovacion = 0;

$(".listaAdicional").on(
  "click",
  "button.btnAgregarCondicionesRenovacion",
  function (e) {
    $(this).removeClass("btnAgregarCondicionesRenovacion");
    $(this).removeClass("btn-primary");
    $(this).addClass("btn-default");
    $(".cardCondicionesRenovacion").removeClass("d-none");
  }
);

$(".listaAdicional").on("click", "button.btnAgregarRenovacion", function (e) {
  $(this).removeClass("btnAgregarRenovacion");
  $(this).removeClass("btn-primary");
  $(this).addClass("btn-default");

  num_lista_dependiente++;
  num_condiciones_renovacion++;

  $(".listaAdicional").append(
    '<div class="col-md-12">' +
      '<div class="card card-primary cardAdicional">' +
      '<div class="card-header">' +
      '<h3 class="card-title">Informaci&oacute;n Adicional</h3>' +
      '<div class="card-tools">' +
      '<button type="button" class="btn btn-tool" data-card-widget="collapse">' +
      '<i class="fas fa-minus"></i>' +
      "</button>" +
      "</div>" +
      "</div>" +
      '<div class="card-body">' +
      '<div class="row">' +
      '<div class="col-md-12">' +
      '<div class="card card-primary cardDependientes">' +
      '<div class="card-header">' +
      '<h3 class="card-title">Informaci&oacute;n Dependientes</h3>' +
      "</div>" +
      '<div class="card-body">' +
      '<div class="row">' +
      '<div class="col-sm-12">' +
      '<div class="form-group row">' +
      '<button type="button" class="btn btn-default btnAgregarDependiente" id="btnAgregarDependiente' +
      num_lista_dependiente +
      '">Agregar Dependencia</button>' +
      '<input type="hidden" class="idListaDependiente" id="idListaDependiente' +
      num_lista_dependiente +
      '" name="idListaDependiente' +
      num_lista_dependiente +
      '" value="' +
      num_lista_dependiente +
      '">' +
      '<input type="hidden" class="idDependiente" id="idDependiente' +
      num_lista_dependiente +
      '" name="idDependiente' +
      num_lista_dependiente +
      '" value="0">' +
      '<input type="hidden" class="condicionEnvio" id="condicionEnvio' +
      num_lista_dependiente +
      '" name="condicionEnvio' +
      num_lista_dependiente +
      '" value="0">' +
      '<input type="hidden" class="listaFamiliares" id="listaFamiliares' +
      num_lista_dependiente +
      '" name="listaFamiliares' +
      num_lista_dependiente +
      '">' +
      "</div>" +
      '<div class="form-group row nuevoDependiente" id="nuevoDependiente' +
      num_lista_dependiente +
      '">' +
      "</div>" +
      "</div>" +
      '<div class="col-sm-12">' +
      '<div class="form-group row">' +
      '<input type="hidden" class="listaVehiculos" id="listaVehiculos' +
      num_lista_dependiente +
      '" name="listaVehiculos' +
      num_lista_dependiente +
      '">' +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="col-md-12">' +
      '<div class="card card-primary cardContrato">' +
      '<div class="card-header">' +
      '<h3 class="card-title">Informaci&oacute;n De Contrato</h3>' +
      "</div>" +
      '<div class="card-body">' +
      '<div class="row">' +
      '<input type="hidden" class="idContrato" id="idContrato' +
      num_lista_dependiente +
      '" name="idContrato' +
      num_lista_dependiente +
      '" value="0">' +
      '<div class="col-sm-12">' +
      '<div class="form-group">' +
      '<div class="form-check">' +
      '<input class="form-check-input chkEstadoPago" id="chkEstadoPago' +
      num_lista_dependiente +
      '" name="chkEstadoPago' +
      num_lista_dependiente +
      '" type="checkbox">' +
      '<label class="form-check-label"><strong>ESTADO DE PAGO</strong></label>' +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="col-sm-6 col-md-4">' +
      '<div class="form-group">' +
      '<label for="txt_numero_contrato' +
      num_lista_dependiente +
      '" class="control-label" style="text-align: right;">Nº CONTRATO<font color="red"> *</font></label>' +
      '<input type="text" class="form-control validarNumerosLetras txt_numero_contrato" id="txt_numero_contrato' +
      num_lista_dependiente +
      '" autocomplete="off" style="text-transform: uppercase">' +
      "</div>" +
      "</div>" +
      '<div class="col-sm-6 col-md-4">' +
      '<div class="form-group">' +
      '<label for="txt_fecha_inicio_contrato' +
      num_lista_dependiente +
      '" class="control-label" style="text-align: right;">FECHA VIGENCIA<font color="red"> *</font></label>' +
      '<input type="date" class="form-control txt_fecha_inicio_contrato" id="txt_fecha_inicio_contrato' +
      num_lista_dependiente +
      '" autocomplete="off">' +
      "</div>" +
      "</div>" +
      '<div class="col-sm-6 col-md-4">' +
      '<div class="form-group">' +
      '<label for="txt_fecha_fin_contrato' +
      num_lista_dependiente +
      '" class="control-label" style="text-align: right;">FECHA ANIVERSARIO<font color="red"> *</font></label>' +
      '<input type="date" class="form-control txt_fecha_fin_contrato" id="txt_fecha_fin_contrato' +
      num_lista_dependiente +
      '" autocomplete="off" disabled>' +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="col-md-12">' +
      '<div class="card card-primary cardCondicionesRenovacion d-none">' +
      '<div class="card-header">' +
      '<h3 class="card-title">Condiciones Renovaci&oacute;n</h3>' +
      "</div>" +
      '<div class="card-body">' +
      '<div class="row">' +
      '<div class="col-md-12">' +
      '<button type="button" class="btn btn-default btnAgregarNuevaCondicionRenovacion">Agregar Condici&oacute;n</button>' +
      '<input type="hidden" class="idCondiciones" id="idCondiciones' +
      num_condiciones_renovacion +
      '" name="idCondiciones' +
      num_condiciones_renovacion +
      '" value = "' +
      num_condiciones_renovacion +
      '">' +
      '<input type="hidden" class="listaCondicionesRenovacion" id="listaCondicionesRenovacion' +
      num_condiciones_renovacion +
      '" name="listaCondicionesRenovacion' +
      num_condiciones_renovacion +
      '">' +
      '<input type="hidden" id="listaCondicionesRenovacion' +
      num_condiciones_renovacion +
      'Anterior" name="listaCondicionesRenovacion' +
      num_condiciones_renovacion +
      'Anterior"></input>' +
      '<input type="hidden" class="rutaDocumentoCondicionRenovacion" id="rutaDocumentoCondicionRenovacion' +
      num_condiciones_renovacion +
      '" name="rutaDocumentoCondicionRenovacion' +
      num_condiciones_renovacion +
      '" value = ""' +
      "</div>" +
      '<div class="col-md-12">' +
      '<div class="row condicionRenovacion" id="condicionRenovacion' +
      num_condiciones_renovacion +
      '">' +
      "</div>" +
      "</div>" +
      "</div>" +
      '<div class="row">' +
      '<div class="col-md-12">' +
      '<label for="txt_documento_condiciones_renovacion" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
      '<input type="file" class="form-control subirDocumento" id="txt_documento_condiciones_renovacion" name="txt_documento_condiciones_renovacion" accept=".pdf">' +
      '<p class="help-block">Peso máximo del documento 50MB</p>' +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>" +
      "</div>"
  );

  /******************************************************
   *********** Cargar el ultimo listado de dependientes
   *******************************************************/
  $("#listaFamiliares" + num_lista_dependiente).val(
    $("#listaFamiliares" + (num_lista_dependiente - 1)).val()
  );
  agregar_auto_familiares(num_lista_dependiente);
});

/*********************************
BLOQUE PARA CARGAR DATOS CLIENTE
*********************************/

function cargar_datos_cliente() {
  var idCliente = $("#txt_idBayer").val();

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "controller/bayer_persona/controlador_traer_datos_cliente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        if (data[0]["categoria_id"] == 3) {
          $("#txt_idEmpleado").val(data[0]["empleado_id"]);
          $("#txt_vendedor").val(data[0]["empleado_nombre"]);
          $("#cbm_origen").val(data[0]["cliente_origen"]).change();
          $("#txt_categoria").val(data[0]["categoria_nombre"]);
          $("#txt_idcategoria").val(data[0]["categoria_id"]);

          if (data[0]["proveedor_id"] != 0) {
            $("#cbm_proveedor").val(data[0]["proveedor_id"]).change();
          }
          $("#txt_planes").val(data[0]["producto_id"]);
          $("#txt_idCliente").val(data[0]["cliente_id"]);
          $("#txt_documento").val(data[0]["cliente_ci"]);
          $("#txt_nombre").val(data[0]["cliente_nombre"]);
          $("#genero").val(data[0]["cliente_genero"]).change();
          $("#estado_civil")
            .val(
              data[0]["cliente_estado_civil"]
                ? data[0]["cliente_estado_civil"].toUpperCase()
                : ""
            )
            .change();
          $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
          $("#txt_edad_nacimiento").val(data[0]["cliente_edad"]);
          $("#txt_telefono").val(data[0]["cliente_telefono"]);
          $("#txt_email").val(data[0]["cliente_email"]);
          $("#txt_telefono_opcional").val(data[0]["cliente_telefono_opcional"]);
          $("#txt_email_opcional").val(data[0]["cliente_email_opcional"]);
          $("#cbm_provincia").val(data[0]["provincia_id"]).change();
          $("#txt_ciudad").val(data[0]["ciudad_id"]);
          $("#txt_direccion").val(data[0]["cliente_direccion"]);
          $("#txt_ocupacion").val(data[0]["cliente_ocupacion"]);
          $("#cbm_ingreso_mensual").val(data[0]["cliente_ingreso"]).change();
          $("#txt_valor_asegurado").val(data[0]["cliente_valor_asegurado"]);
          $("#txt_prima_neta").val(data[0]["cliente_prima_neta"]);
          $("#txt_prima_comisionable").val(
            data[0]["cliente_prima_comisionable"]
          );
          $("#txt_prima_total").val(data[0]["cliente_prima_total"]);
          $("#cbm_tipo_pago").val(data[0]["cliente_tipo_pago"]).change();
          $("#cbm_forma_pago").val(data[0]["cliente_forma_pago"]).change();
          $("#txt_fecha_seguimiento").val(data[0]["cliente_fecha_seguimiento"]);
          $("#cbm_estado_bayer").val(data[0]["cliente_estado_bayer"]).change();
          $("#cantidadDocumentos").val(0);

          cargar_datos_cliente_dependientes();

          agregar_auto_observaciones();

          actualizar_edad_fecha_nacimiento();

          block_info_cliente();

          // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
          $(".valores_emision").number(true, 2);
        } else {
          return (window.location = "clientes-asistencia-medica-individual");
        }
      } else {
        return (window.location = "clientes-asistencia-medica-individual");
      }
    },
  });
}

function block_info_cliente() {
  var status = true;

  if ($("#txt_idCliente").val() === "0" || $("#txt_idCliente").val() === "") {
    status = false;
  } else {
    status = true;
  }
  $("#txt_documento").prop("disabled", status);
  $("#txt_nombre").prop("disabled", status);
  $("#genero").prop("disabled", status);
  // $("#estado_civil").prop("disabled", status);
  $("#txt_fecha_nacimiento").prop("disabled", status);
  $("#txt_edad_nacimiento").prop("disabled", status);
  $("#txt_telefono").prop("disabled", status);
  $("#txt_email").prop("disabled", status);
  $("#cbm_provincia").prop("disabled", status);
  $("#txt_ciudad").prop("disabled", status);
  $("#txt_direccion").prop("disabled", status);
  $("#txt_ocupacion").prop("disabled", status);
  $("#cbm_ingreso_mensual").prop("disabled", status);
}

$("#txt_fecha_nacimiento").on("change", function () {
  actualizar_edad_fecha_nacimiento();
});

function actualizar_edad_fecha_nacimiento() {
  var fechaNacimiento = $("#txt_fecha_nacimiento").val();
  var edad = getEdad(fechaNacimiento);
  $("#txt_edad_nacimiento").val(edad);
}

function cargar_datos_cliente_dependientes() {
  var idCliente = $("#txt_idBayer").val();

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "controller/bayer-dependientes/controlador_traer_datos_cliente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        agregar_auto_lista_dependientes(data);
      }
    },
  });
}

var num_lista_dependiente = 0;

function agregar_auto_lista_dependientes(data) {
  var numero_renov = data.length - 1;

  for (let i = 0; i < data.length; i++) {
    num_lista_dependiente++;
    // console.log(data[i]["bayer_dependiente_id"]);

    if (i < numero_renov) {
      if (data[i]["cliente_condiciones"] != null) {
        condicion_renovacion = cargar_condiciones_renovacion(
          data[i]["cliente_condiciones"],
          data[i]["cliente_condiciones_envio"],
          data[i]["cliente_ruta_condiciones_documento"],
          data[i]["contrato_estatus"]
        );
        estado = "d-none";
      } else {
        estado = "";
        condicion_renovacion = "";
      }
    } else {
      estado = "";
      condicion_renovacion = cargar_condiciones_renovacion(
        data[i]["cliente_condiciones"],
        data[i]["cliente_condiciones_envio"],
        data[i]["cliente_ruta_condiciones_documento"],
        data[i]["contrato_estatus"]
      );
    }

    if (data[i]["cliente_condiciones_envio"] == 0) {
      boton_activar = "btn-primary btnAgregarCondicionesRenovacion";
    } else {
      boton_activar = "btn-default";
    }

    var icon = "";
    var minimizar = "";

    if (i < numero_renov) {
      minimizar = "collapsed-card";
      icon = "fas fa-plus";
    } else {
      minimizar = "";
      icon = "fas fa-minus";
    }
    // console.log(i);
    // console.log(numero_renov);

    $(".listaAdicional").append(
      '<div class="col-md-12">' +
        '<div class="card card-primary cardAdicional ' +
        minimizar +
        '">' +
        '<div class="card-header">' +
        '<h3 class="card-title">Vigencia Nº ' +
        (i + 1) +
        "</h3>" +
        '<div class="card-tools">' +
        '<button type="button" class="btn btn-tool" data-card-widget="collapse">' +
        '<i class="' +
        icon +
        '"></i>' +
        "</button>" +
        "</div>" +
        "</div>" +
        '<div class="card-body">' +
        '<div class="row">' +
        '<div class="col-md-12">' +
        '<div class="card card-primary cardDependientes">' +
        '<div class="card-header">' +
        '<h3 class="card-title">Informaci&oacute;n Dependientes</h3>' +
        "</div>" +
        '<div class="card-body">' +
        '<div class="row">' +
        '<div class="col-sm-12">' +
        '<div class="form-group row">' +
        '<button type="button" class="btn btn-default btnAgregarDependiente" id="btnAgregarDependiente' +
        num_lista_dependiente +
        '">Agregar Dependencia</button>' +
        '<input type="hidden" class="idListaDependiente" id="idListaDependiente' +
        num_lista_dependiente +
        '" name="idListaDependiente' +
        num_lista_dependiente +
        '" value="' +
        num_lista_dependiente +
        '">' +
        '<input type="hidden" class="idDependiente" id="idDependiente' +
        num_lista_dependiente +
        '" name="idDependiente' +
        num_lista_dependiente +
        '" value="' +
        data[i]["bayer_dependiente_id"] +
        '">' +
        '<input type="hidden" class="condicionEnvio" id="condicionEnvio' +
        num_lista_dependiente +
        '" name="condicionEnvio' +
        num_lista_dependiente +
        '" value="' +
        data[i]["cliente_condiciones_envio"] +
        '">' +
        '<input type="hidden" class="listaFamiliares" id="listaFamiliares' +
        num_lista_dependiente +
        '" name="listaFamiliares' +
        num_lista_dependiente +
        '">' +
        "</div>" +
        '<div class="form-group row nuevoDependiente" id="nuevoDependiente' +
        num_lista_dependiente +
        '">' +
        "</div>" +
        "</div>" +
        '<div class="col-sm-12">' +
        '<div class="form-group row">' +
        '<input type="hidden" class="listaVehiculos" id="listaVehiculos' +
        num_lista_dependiente +
        '" name="listaVehiculos' +
        num_lista_dependiente +
        '">' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="col-md-12">' +
        '<div class="card card-primary cardContrato">' +
        '<div class="card-header">' +
        '<h3 class="card-title">Informaci&oacute;n De Contrato</h3>' +
        "</div>" +
        '<div class="card-body">' +
        '<div class="row">' +
        '<input type="hidden" class="idContrato" id="idContrato' +
        num_lista_dependiente +
        '" name="idContrato' +
        num_lista_dependiente +
        '" value="' +
        data[i]["contrato_id"] +
        '">' +
        '<div class="col-sm-12">' +
        '<div class="form-group">' +
        '<div class="form-check">' +
        '<input class="form-check-input chkEstadoPago" id="chkEstadoPago' +
        num_lista_dependiente +
        '" name="chkEstadoPago' +
        num_lista_dependiente +
        '" type="checkbox">' +
        '<label class="form-check-label"><strong>ESTADO DE PAGO</strong></label>' +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="col-sm-6 col-md-4">' +
        '<div class="form-group">' +
        '<label for="txt_numero_contrato' +
        num_lista_dependiente +
        '" class="control-label" style="text-align: right;">Nº CONTRATO<font color="red"> *</font></label>' +
        '<input type="text" class="form-control validarNumerosLetras txt_numero_contrato" id="txt_numero_contrato' +
        num_lista_dependiente +
        '" autocomplete="off" style="text-transform: uppercase">' +
        "</div>" +
        "</div>" +
        '<div class="col-sm-6 col-md-4">' +
        '<div class="form-group">' +
        '<label for="txt_fecha_inicio_contrato' +
        num_lista_dependiente +
        '" class="control-label" style="text-align: right;">FECHA VIGENCIA<font color="red"> *</font></label>' +
        '<input type="date" class="form-control txt_fecha_inicio_contrato" id="txt_fecha_inicio_contrato' +
        num_lista_dependiente +
        '" autocomplete="off">' +
        "</div>" +
        "</div>" +
        '<div class="col-sm-6 col-md-4">' +
        '<div class="form-group">' +
        '<label for="txt_fecha_fin_contrato' +
        num_lista_dependiente +
        '" class="control-label" style="text-align: right;">FECHA ANIVERSARIO<font color="red"> *</font></label>' +
        '<input type="date" class="form-control txt_fecha_fin_contrato" id="txt_fecha_fin_contrato' +
        num_lista_dependiente +
        '" autocomplete="off" disabled>' +
        "</div>" +
        "</div>" +
        '<div class="col-sm-12 ' +
        estado +
        '">' +
        '<button type="button" class="btn ' +
        boton_activar +
        '" id="btnAgregarCondicionesRenovacion' +
        num_lista_dependiente +
        '">Agregar Condiciones Renovacion</button>' +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>" +
        condicion_renovacion +
        "</div>" +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $("#listaFamiliares" + num_lista_dependiente).val(
      data[i]["cliente_familiares"]
    );
    agregar_auto_familiares(num_lista_dependiente);

    if (data[i]["contrato_estado_pago"] == 1) {
      $("#chkEstadoPago" + num_lista_dependiente).prop("checked", true);
    }

    $("#txt_numero_contrato" + num_lista_dependiente).val(
      data[i]["contrato_numero"]
    );
    $("#txt_fecha_inicio_contrato" + num_lista_dependiente).val(
      data[i]["contrato_fecha_inicio"]
    );
    $("#txt_fecha_fin_contrato" + num_lista_dependiente).val(
      data[i]["contrato_fecha_fin"]
    );
  }
}

function cargar_condiciones_renovacion(
  listaCondiciones,
  condiciones_envio,
  ruta_condiciones_documento,
  contrato_estatus
) {
  num_condiciones_renovacion++;

  // console.log(listaCondiciones);
  var btnDocumentoCondiciones = "";
  var btnRenovacion = "";
  var estado = "";

  switch (ruta_condiciones_documento) {
    case null:
      ruta_condiciones_documento = "";

      if (contrato_estatus == "ACTIVO") {
        btnDocumentoCondiciones =
          '<div class="row">' +
          '<div class="col-md-12">' +
          '<label for="txt_documento_condiciones_renovacion" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
          '<input type="file" class="form-control subirDocumento" id="txt_documento_condiciones_renovacion" name="txt_documento_condiciones_renovacion" accept=".pdf">' +
          '<p class="help-block">Peso máximo del documento 50MB</p>' +
          "</div>" +
          "</div>";
      } else {
        btnDocumentoCondiciones =
          '<div class="row">' +
          '<div class="col-md-12">' +
          '<label for="btnVerDocumentoCondiciones" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
          '<button type="button" class="btn btn-primary btnVerDocumentoCondiciones" id="btnVerDocumentoCondiciones" ruta="' +
          ruta_condiciones_documento +
          '">Ver Condiciones</button>' +
          "</div>" +
          "</div>";
      }

      break;
    case "":
      ruta_condiciones_documento = "";

      if (contrato_estatus == "ACTIVO") {
        btnDocumentoCondiciones =
          '<div class="row">' +
          '<div class="col-md-12">' +
          '<label for="txt_documento_condiciones_renovacion" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
          '<input type="file" class="form-control subirDocumento" id="txt_documento_condiciones_renovacion" name="txt_documento_condiciones_renovacion" accept=".pdf">' +
          '<p class="help-block">Peso máximo del documento 50MB</p>' +
          "</div>" +
          "</div>";
      } else {
        btnDocumentoCondiciones =
          '<div class="row">' +
          '<div class="col-md-12">' +
          '<label for="btnVerDocumentoCondiciones" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
          '<button type="button" class="btn btn-primary btnVerDocumentoCondiciones" id="btnVerDocumentoCondiciones" ruta="' +
          ruta_condiciones_documento +
          '">Ver Condiciones</button>' +
          "</div>" +
          "</div>";
      }

      break;

    default:
      btnDocumentoCondiciones =
        '<div class="row">' +
        '<div class="col-md-12">' +
        '<label for="btnVerDocumentoCondiciones" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>' +
        '<button type="button" class="btn btn-primary btnVerDocumentoCondiciones" id="btnVerDocumentoCondiciones" ruta="' +
        ruta_condiciones_documento +
        '">Ver Condiciones</button>' +
        "</div>" +
        "</div>";
      break;
  }

  if (condiciones_envio == 0) {
    estado = "d-none";
  } else {
    estado = "";
  }
  if (condiciones_envio == 1 && contrato_estatus == "ACTIVO") {
    btnRenovacion =
      '<div class="row">' +
      '<div class="col-sm-12">' +
      '<button type="button" class="btn btn-primary btnAgregarRenovacion" id="btnAgregarRenovacion">Agregar Renovacion</button>' +
      "</div>" +
      "</div>";
  }

  var condiciones = agregar_auto_cargar_condiciones_renovacion(
    listaCondiciones,
    num_condiciones_renovacion
  );

  var dato =
    '<div class="col-md-12">' +
    '<div class="card card-primary cardCondicionesRenovacion ' +
    estado +
    '">' +
    '<div class="card-header">' +
    '<h3 class="card-title">Condiciones Renovaci&oacute;n</h3>' +
    "</div>" +
    '<div class="card-body">' +
    '<div class="row">' +
    '<div class="col-md-12">' +
    '<button type="button" class="btn btn-default btnAgregarNuevaCondicionRenovacion">Agregar Condici&oacute;n</button>' +
    '<input type="hidden" class="idCondiciones" id="idCondiciones' +
    num_condiciones_renovacion +
    '" name="idCondiciones' +
    num_condiciones_renovacion +
    '" value = "' +
    num_condiciones_renovacion +
    '">' +
    '<input type="hidden" class="listaCondicionesRenovacion" id="listaCondicionesRenovacion' +
    num_condiciones_renovacion +
    '" name="listaCondicionesRenovacion' +
    num_condiciones_renovacion +
    '">' +
    '<input type="hidden" id="listaCondicionesRenovacion' +
    num_condiciones_renovacion +
    'Anterior" name="listaCondicionesRenovacion' +
    num_condiciones_renovacion +
    'Anterior"></input>' +
    '<input type="hidden" class="rutaDocumentoCondicionRenovacion" id="rutaDocumentoCondicionRenovacion' +
    num_condiciones_renovacion +
    '" name="rutaDocumentoCondicionRenovacion' +
    num_condiciones_renovacion +
    '" value = "' +
    ruta_condiciones_documento +
    '">' +
    "</div>" +
    '<div class="col-md-12">' +
    '<div class="row condicionRenovacion" id="condicionRenovacion' +
    num_condiciones_renovacion +
    '">' +
    condiciones +
    "</div>" +
    "</div>" +
    "</div>" +
    // '<div class="row">'+
    //   '<div class="col-md-12">'+
    //     '<label for="txt_documento_condiciones_renovacion" class="control-label" style="text-align: right;">DOCUMENTOS CONDICIONES RENOVACI&Oacute;N<font color="red"> *</font></label>'+
    //     '<input type="file" class="form-control subirDocumento" id="txt_documento_condiciones_renovacion" name="txt_documento_condiciones_renovacion" accept=".pdf">'+
    //     '<p class="help-block">Peso máximo del documento 50MB</p>'+
    //   '</div>'+
    // '</div>'+
    btnDocumentoCondiciones +
    btnRenovacion +
    "</div>" +
    "</div>" +
    "</div>";

  return dato;
}

function agregar_auto_cargar_condiciones_renovacion(listaCondiciones, valor) {
  var dato = "";

  if (listaCondiciones != null) {
    data = JSON.parse(listaCondiciones);

    for (let i = 0; i < data.length; i++) {
      var estado = "";

      if (numCondicionRequerida > 1) {
        estado = "d-md-none";
      } else {
        estado = "";
      }

      dato +=
        '<div class="col-12 my-1">' +
        '<div class="row gridCondiconesRenovacion">' +
        "<!-- Condiciones -->" +
        '<div class="my-1 col-12 col-md-6 order-md-1 ' +
        estado +
        '">' +
        "<label>FORMAS DE PAGO</label>" +
        "</div>" +
        '<div class="my-1 col-12 col-md-6 order-md-5">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosLetras condicionRequerido' +
        valor +
        '" id="condicionRequerido' +
        numCondicionRequerida +
        '" name="condicionRequerido' +
        numCondicionRequerida +
        '" placeholder="CONDICION REQUERIDO" autocomplete="off" value="' +
        data[i]["condicion"] +
        '" style="text-transform: uppercase"></input>' +
        "</div>" +
        "</div>" +
        "<!-- VALOR -->" +
        '<div class="my-1 col-12 col-md-4 order-md-2 ' +
        estado +
        '">' +
        "<label>VALOR USD</label>" +
        "</div>" +
        '<div class="my-1 col-12 col-md-4 order-md-6">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosDecimal valorRequerido' +
        valor +
        '" id="valorRequerido' +
        numCondicionRequerida +
        '" name="valorRequerido' +
        numCondicionRequerida +
        '" placeholder="VALOR REQUERIDO" autocomplete="off" style="text-transform: uppercase" value="' +
        data[i]["valor"] +
        '"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Acciones -->" +
        '<div class="my-1 col-12 col-md-2 order-md-3 ' +
        estado +
        '">' +
        "<label></label>" +
        "</div>" +
        '<div class="my-1 col-12 col-md-2 order-md-7">' +
        '<button type="button" class="form-control btn btn-default" idDocumento="' +
        numCondicionRequerida +
        '"><i class="fa fa-times"></i></button>' +
        "</div>" +
        "</div>" +
        "</div>";

      numCondicionRequerida++;
    }
  }

  // console.log(dato);

  return dato;
}

var numCondicionRequerida = 1;

function agregar_auto_familiares(idValor) {
  var lista = $("#listaFamiliares" + idValor).val();

  if (lista.length > 0) {
    var data = JSON.parse(lista);

    for (let i = 0; i < data.length; i++) {
      numProspecto++;

      var estado = "";
      var estado1 = "";
      var valor = 0;

      if (numProspecto > 1) {
        estado = "d-md-none";
        estado1 = "d-none";
      } else {
        estado = "";
        estado1 = "";
      }

      if (data[i]["valor_deducible"] > 0) {
        valor = data[i]["valor_deducible"];
      } else {
        valor = 0.0;
      }

      $("#nuevoDependiente" + idValor).append(
        '<div class="col-12">' +
          '<div class="row">' +
          "<!-- Parentesco -->" +
          '<div class="col-6 col-md-1 order-md-1 my-1 ' +
          estado +
          ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
          numProspecto +
          '" style="padding-right:0px">' +
          "<label>Parentesco</label>" +
          "</div>" +
          '<div class="col-6 col-md-1 order-md-7 my-1" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<select class="form-control tipoFamiliar' +
          idValor +
          '" id="tipoFamiliar' +
          numProspecto +
          '" name="tipoFamiliar' +
          numProspecto +
          '" required>' +
          '<option value= "">Seleccione...</option>' +
          '<option value= "Titular">Titular</option>' +
          '<option value= "Conyuge">Conyuge</option>' +
          '<option value= "Hijo/a">Hijo/a</option>' +
          '<option value= "Otro">Otro</option>' +
          '<option value= "Familiar">Familiar</option>' +
          "</select>" +
          "</div>" +
          "</div>" +
          "<!-- Nombre -->" +
          '<div class="col-6 col-md-4 order-md-2 my-1 ' +
          estado +
          ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
          numProspecto +
          '">' +
          "<label>Nombre</label>" +
          "</div>" +
          '<div class="col-6 col-md-4 order-md-8 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras nombreFamiliar' +
          idValor +
          '" id="nombreFamiliar' +
          numProspecto +
          '" name="nombreFamiliar' +
          numProspecto +
          '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Genero -->" +
          '<div class="col-6 col-md-2 order-md-3 my-1 ' +
          estado +
          ' etiquetaGeneroFamiliar" id = "etiquetaGeneroFamiliar' +
          numProspecto +
          '">' +
          "<label>Genero</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-9 my-1">' +
          '<select class="form-control generoFamiliar' +
          idValor +
          '" id="generoFamiliar' +
          numProspecto +
          '" name="generoFamiliar' +
          numProspecto +
          '">' +
          '<option value="">Seleccione...</option>' +
          '<option value="masculino">Masculino</option>' +
          '<option value="femenino">Femenino</option>' +
          "</select>" +
          "</div>" +
          "<!-- Fecha de Nacimiento -->" +
          '<div class="col-6 col-md-2 order-md-4 my-1 ' +
          estado +
          ' etiquetaFechaNacimiento" id = "etiquetaFechaNacimiento' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label>Fecha Nacimiento</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="date" class="form-control fecha_nacimiento_Familiar' +
          idValor +
          '" id="fecha_nacimiento_Familiar' +
          numProspecto +
          '" name="fecha_nacimiento_Familiar' +
          numProspecto +
          '">' +
          "</div>" +
          "</div>" +
          "<!-- Deducible -->" +
          '<div class="col-6 col-md-2 order-md-5 my-1 ' +
          estado +
          ' etiquetaDeducibleFamiliar" id = "etiquetaDeducibleFamiliar' +
          numProspecto +
          '">' +
          "<label>Deducible</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-11 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosDecimal deducibleFamiliar' +
          idValor +
          '" id="deducibleFamiliar' +
          numProspecto +
          '" name="deducibleFamiliar' +
          numProspecto +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="col-6 col-md-1 order-md-6 my-1 ' +
          estado1 +
          ' etiquetaAcciones" id = "etiquetaAcciones' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label></label>" +
          "</div>" +
          '<div class="col-12 col-md-1 order-md-12 my-1" style="padding-left:0px">' +
          '<button type="button" class="form-control btn btn-danger quitarDependiente idFamiliar="' +
          numProspecto +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoFamiliar" + numProspecto)
        .val(data[i]["tipo"])
        .change();
      $("#nombreFamiliar" + numProspecto).val(data[i]["nombre"]);
      $("#generoFamiliar" + numProspecto)
        .val(data[i]["genero"])
        .change();
      $("#fecha_nacimiento_Familiar" + numProspecto).val(
        data[i]["fecha_nacimiento"]
      );
      $("#deducibleFamiliar" + numProspecto).val(valor);
    }
  }
}

function agregar_auto_observaciones() {
  var idCliente = $("#txt_idBayer").val();

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "controller/clientes/controlador_observacion_cliente_listar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#listaObservaciones").val(data[0]["observacion_descripcion"]);

        var data1 = JSON.parse($("#listaObservaciones").val());

        for (let i = 0; i < data1.length; i++) {
          numObservacion++;

          var estado = "";
          var estado1 = "";

          if (numObservacion > 1) {
            estado = "d-md-none";
            estado1 = "d-none";
          } else {
            estado = "";
            estado1 = "";
          }

          $(".nuevaObservacion").append(
            '<div class="col-12 my-1">' +
              '<div class="row">' +
              "<!-- Fecha de Registro -->" +
              '<div class="col-6 col-md-4 order-md-1 my-1 ' +
              estado +
              ' etiquetaFechaObservacion" id="etiquetaFechaObservacion' +
              numObservacion +
              '" style="padding-right:0px">' +
              "<label>Fecha Registro</label>" +
              "</div>" +
              '<div class="col-6 col-md-4 order-md-4 my-1" style="padding-right:0px">' +
              '<div class="input-group">' +
              '<label class="fecha_registro" id="fecha_registro' +
              numObservacion +
              '" name="fecha_registro' +
              numObservacion +
              '">' +
              data1[i]["fecha_registro"] +
              "</label>" +
              "</div>" +
              "</div>" +
              "<!-- Observacion -->" +
              '<div class="col-6 col-md-4 order-md-2 my-1 ' +
              estado +
              ' etiquetaDescripcionObservacion" id="etiquetaDescripcionObservacion' +
              numObservacion +
              '">' +
              "<label>Observaci&oacute;n</label>" +
              "</div>" +
              '<div class="col-6 col-md-4 order-md-5 my-1">' +
              '<label class="observacion" id="observacion' +
              numObservacion +
              '" name="observacion' +
              numObservacion +
              '">' +
              data1[i]["observacion"] +
              "</label>" +
              "</div>" +
              '<div class="col-6 col-md-2 order-md-3 my-1 ' +
              estado1 +
              ' etiquetaAccionesObservacion" id ="etiquetaAccionesObservacion' +
              numObservacion +
              '">' +
              "<label></label>" +
              "</div>" +
              '<div class="col-12 col-md-2 order-md-6 my-1">' +
              // '<button type="button" class="form-control btn btn-default btn-xs idObservacion="' + numObservacion + '"><i class="fa fa-times"></i></button>'+
              "</div>" +
              "</div>" +
              "</div>"
          );
        }
      }
    },
  });
}

$('.subirDocumento [type="file"]').on("change", function () {
  var documento = this.files[0];
  // Tamaño correcto en bytes (50 MB reales)
  var maxSizeMB = 50;
  var maxSizeBytes = maxSizeMB * 1024 * 1024;

  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

  if (documento["type"] != "application/pdf") {
    $(this).val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento debe estar en formato PDF!",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (documento["size"] > maxSizeBytes) {
    $(this).val("");

    Swal.fire({
      icon: "error",
      title: "Error al subir el documento",
      text: "¡El documento no debe pesar más de " + maxSizeMB + "MB!",
      confirmButtonText: "¡Cerrar!",
    });
  }

  /*=============================================
  LISTAR DOCUMENTOS
  =============================================*/
  listarDocumentos();
});

/*=============================================
LISTAR DOCUMENTOS
=============================================*/

function listarDocumentos() {
  var cantidad = 0;

  var documento = $('#grupo_file [type="file"]');

  for (var i = 0; i < documento.length; i++) {
    cantidad += 1;
  }

  $("#cantidadDocumentos").val(cantidad);
}

function crear_overlay_asistencia_medica() {
  $("#cardBayer").append(
    '<div class="overlay dark" id="overlayBayer"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardPersonal").append(
    '<div class="overlay dark" id="overlayPersonal"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $(".cardAdicional").append(
    '<div class="overlay dark overlayDependientes"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardDocumento").append(
    '<div class="overlay dark" id="overlayDocumentos"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardSeguimiento").append(
    '<div class="overlay dark" id="overlaySeguimiento"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_asistencia_medica() {
  $("#overlayBayer").remove();
  $("#overlayPersonal").remove();
  $(".overlayDependientes").remove();
  $("#overlayDocumentos").remove();
  $("#overlaySeguimiento").remove();
}

/*********************************
 MODIFICAR DATOS CLIENTE
 *********************************/
function Modificar_Cliente() {
  listarFamiliares();
  listarDependientesContrato();
  listarContratos();
  listarCondiciones();
  listarTotalCondiciones();
  listarDocumentos();

  var idBayer = $("#txt_idBayer").val();
  var origen = $("#cbm_origen").val();
  var categoria = $("#txt_idcategoria").val();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val().trim();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre = $("#txt_nombre").val().trim().toUpperCase();
  var genero = $("#genero").val();
  var estado_civil = $("#estado_civil").val();
  var fecha_nacimiento = $("#txt_fecha_nacimiento").val();
  var edad_nacimiento = $("#txt_edad_nacimiento").val();
  var telefono = $("#txt_telefono").val().trim();
  var email = $("#txt_email").val().trim();
  var telefono_opcional = $("#txt_telefono_opcional").val().trim();
  var email_opcional = $("#txt_email_opcional").val().trim();
  var provincia = $("#cbm_provincia").val();
  var ciudad = $("#txt_ciudad").val().trim().toUpperCase();
  var direccion = $("#txt_direccion").val().trim().toUpperCase();
  var ocupacion = $("#txt_ocupacion").val().trim().toUpperCase();
  var valor_ingreso = $("#cbm_ingreso_mensual").val();
  var valor_asegurado = $("#txt_valor_asegurado").val().trim();
  var prima_neta = $("#txt_prima_neta").val().trim();
  var prima_comisionable = $("#txt_prima_comisionable").val().trim();
  var prima_total = $("#txt_prima_total").val();
  var tipo_pago = $("#cbm_tipo_pago").val();
  var forma_pago = $("#cbm_forma_pago").val();
  var estado_bayer = $("#cbm_estado_bayer").val();
  var listaDependientesContrato = $("#listaDependientesContrato").val();
  var listaContratos = $("#listaContratos").val();
  var listaTotalCondiciones = $("#listaTotalCondiciones").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var idEmpleado = $("#txt_idEmpleado").val();

  /**============================
   BLOQUE PARA CARGAR DOCUMENTOS
   * ============================
   */
  var documento_1;
  var documento_2;
  var documento_3;
  var documento_4;
  var documento_5;
  var documento_6;
  var documento_7;
  var documento_8;
  var documento_9;
  var documento_10;

  var cantidad = $("#cantidadDocumentos").val();

  /**============================
   BLOQUE PARA CARGAR DOCUMENTOS CONDICIONES
   * ============================
   */
  var documento_condiciones;

  if (idCliente.length == 0) {
    idCliente = 0;
  }

  if (origen.length == 0 || origen == null) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo origen",
      "warning"
    );
  }

  if (categoria.length == 0 || categoria == null) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo de Ramo",
      "warning"
    );
  }

  if (categoria == 0 && nuevo_categoria.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo de nuevo Ramo",
      "warning"
    );
  }

  if (nombre.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo  nombre cliente",
      "warning"
    );
  }

  if (genero.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo genero cliente",
      "warning"
    );
  }

  if (provincia < 1) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo de provincia",
      "warning"
    );
  }

  if (cedula.length < 10 && estado_bayer == "CONTRATADO") {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Ingrese numero de Cedula y/o Ruc valido",
      "warning"
    );
  }

  if (estado_bayer.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el estado del cliente",
      "warning"
    );
  }

  if (
    origen.length == 0 ||
    categoria.length == 0 ||
    proveedor.length == 0 ||
    idProducto.length == 0 ||
    cedula.length == 0 ||
    nombre.length == 0 ||
    genero.length == 0 ||
    estado_civil.length == 0 ||
    fecha_nacimiento.length == 0 ||
    edad_nacimiento.length == 0 ||
    telefono.length == 0 ||
    email.length == 0 ||
    provincia.length == 0 ||
    ciudad.length == 0 ||
    direccion.length == 0 ||
    ocupacion.length == 0 ||
    valor_ingreso.length == 0 ||
    valor_asegurado.length == 0 ||
    prima_neta.length == 0 ||
    prima_comisionable.length == 0 ||
    prima_total.length == 0 ||
    tipo_pago.length == 0 ||
    forma_pago.length == 0 ||
    estado_bayer.length == 0
  ) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios",
      "warning"
    );
  }

  var nombre_documento_1 = $("#txt_nombre_documento_1").val();
  var archivo1 = $("#txt_documento_1").val();
  var extension_1 = archivo1.split(".").pop();
  documento_1 = $("#txt_documento_1")[0].files[0];

  var nombre_documento_2 = $("#txt_nombre_documento_2").val();
  var archivo2 = $("#txt_documento_2").val();
  var extension_2 = archivo2.split(".").pop();
  documento_2 = $("#txt_documento_2")[0].files[0];

  var nombre_documento_3 = $("#txt_nombre_documento_3").val();
  var archivo3 = $("#txt_documento_3").val();
  var extension_3 = archivo3.split(".").pop();
  documento_3 = $("#txt_documento_3")[0].files[0];

  var nombre_documento_4 = $("#txt_nombre_documento_4").val();
  var archivo4 = $("#txt_documento_4").val();
  var extension_4 = archivo4.split(".").pop();
  documento_4 = $("#txt_documento_4")[0].files[0];

  var nombre_documento_5 = $("#txt_nombre_documento_5").val();
  var archivo5 = $("#txt_documento_5").val();
  var extension_5 = archivo5.split(".").pop();
  documento_5 = $("#txt_documento_5")[0].files[0];

  var nombre_documento_6 = $("#txt_nombre_documento_6").val();
  var archivo6 = $("#txt_documento_6").val();
  var extension_6 = archivo6.split(".").pop();
  documento_6 = $("#txt_documento_6")[0].files[0];

  var nombre_documento_7 = $("#txt_nombre_documento_7").val();
  var archivo7 = $("#txt_documento_7").val();
  var extension_7 = archivo7.split(".").pop();
  documento_7 = $("#txt_documento_7")[0].files[0];

  var nombre_documento_8 = $("#txt_nombre_documento_8").val();
  var archivo8 = $("#txt_documento_8").val();
  var extension_8 = archivo8.split(".").pop();
  documento_8 = $("#txt_documento_8")[0].files[0];

  var nombre_documento_9 = $("#txt_nombre_documento_9").val();
  var archivo9 = $("#txt_documento_9").val();
  var extension_9 = archivo9.split(".").pop();
  documento_9 = $("#txt_documento_9")[0].files[0];

  var nombre_documento_10 = $("#txt_nombre_documento_10").val();
  var archivo10 = $("#txt_documento_10").val();
  var extension_10 = archivo10.split(".").pop();
  documento_10 = $("#txt_documento_10")[0].files[0];

  var nombre_documento_condiciones = "";
  var archivo_condiciones = "";
  var extension_condiciones = "";

  if ($("#txt_documento_condiciones_renovacion").length > 0) {
    // nombre_documento_condiciones = $("#txt_documento_condiciones_renovacion").val();
    archivo_condiciones = $("#txt_documento_condiciones_renovacion").val();
    extension_condiciones = archivo_condiciones.split(".").pop();
    documento_condiciones = $("#txt_documento_condiciones_renovacion")[0]
      .files[0];
  }

  crear_overlay_asistencia_medica();

  var datos = new FormData();

  datos.append("idBayer", idBayer);
  datos.append("origen", origen);
  datos.append("categoria", categoria);
  datos.append("proveedor", proveedor);
  datos.append("idProducto", idProducto);
  datos.append("idCliente", idCliente);
  datos.append("cedula", cedula);
  datos.append("nombre", nombre);
  datos.append("genero", genero);
  datos.append("estado_civil", estado_civil);
  datos.append("fecha_nacimiento", fecha_nacimiento);
  datos.append("edad_nacimiento", edad_nacimiento);
  datos.append("telefono", telefono);
  datos.append("email", email);
  datos.append("telefono_opcional", telefono_opcional);
  datos.append("email_opcional", email_opcional);
  datos.append("provincia", provincia);
  datos.append("ciudad", ciudad);
  datos.append("direccion", direccion);
  datos.append("ocupacion", ocupacion);
  datos.append("valor_ingreso", valor_ingreso);
  datos.append("valor_asegurado", valor_asegurado);
  datos.append("prima_neta", prima_neta);
  datos.append("prima_comisionable", prima_comisionable);
  datos.append("prima_total", prima_total);
  datos.append("tipo_pago", tipo_pago);
  datos.append("forma_pago", forma_pago);
  datos.append("estado_bayer", estado_bayer);
  datos.append("listaDependientesContrato", listaDependientesContrato);
  datos.append("listaContratos", listaContratos);
  datos.append("listaTotalCondiciones", listaTotalCondiciones);
  datos.append("listaObservaciones", listaObservaciones);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append("idEmpleado", idEmpleado);

  /**======================================
   * ===DOCUMNETO ADJUNTOS AL CONTRATO=====
   ========================================*/

  datos.append("nombre_documento_1", nombre_documento_1);
  datos.append("documento_1", documento_1);
  datos.append("extension_1", extension_1);
  datos.append("nombre_documento_2", nombre_documento_2);
  datos.append("documento_2", documento_2);
  datos.append("extension_2", extension_2);
  datos.append("nombre_documento_3", nombre_documento_3);
  datos.append("documento_3", documento_3);
  datos.append("extension_3", extension_3);
  datos.append("nombre_documento_4", nombre_documento_4);
  datos.append("documento_4", documento_4);
  datos.append("extension_4", extension_4);
  datos.append("nombre_documento_5", nombre_documento_5);
  datos.append("documento_5", documento_5);
  datos.append("extension_5", extension_5);
  datos.append("nombre_documento_6", nombre_documento_6);
  datos.append("documento_6", documento_6);
  datos.append("extension_6", extension_6);
  datos.append("nombre_documento_7", nombre_documento_7);
  datos.append("documento_7", documento_7);
  datos.append("extension_7", extension_7);
  datos.append("nombre_documento_8", nombre_documento_8);
  datos.append("documento_8", documento_8);
  datos.append("extension_8", extension_8);
  datos.append("nombre_documento_9", nombre_documento_9);
  datos.append("documento_9", documento_9);
  datos.append("extension_9", extension_9);
  datos.append("nombre_documento_10", nombre_documento_10);
  datos.append("documento_10", documento_10);
  datos.append("extension_10", extension_10);

  datos.append("cantidad", cantidad);

  /**======================================
   * ===DOCUMENTO ADJUNTO CONDICIONES=====
   ========================================*/
  datos.append("nombre_documento_condiciones", nombre_documento_condiciones);
  datos.append("documento_condiciones", documento_condiciones);
  datos.append("extension_condiciones", extension_condiciones);

  $.ajax({
    url: "controller/clientes/controlador_cliente_asistencia_medica_individual_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        if (data[0]["valor"] == 1) {
          Swal.fire(
            "Mensaje De Confirmacion",
            "Datos correctamente, Actualizado Cliente",
            "success"
          ).then((value) => {
            window.location = "clientes-asistencia-medica-individual";
          });
        } else {
          return Swal.fire(
            "Mensaje De Advertencia",
            "Lo sentimos, la cedula ya esta registrada en otro cliente",
            "warning"
          );
        }
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
      eliminar_overlay_asistencia_medica();
    },
  });
}

/*=============================================
LISTAR CLIENTES EXISTENTES
=============================================*/

$(".btnListarClientes").click(function () {
  $("#modalListarClientes").modal({ backdrop: "static", keyboard: false });
  $("#modalListarClientes").modal("show");
  table_clientes_seleccionar.ajax.reload();
});

var table_clientes_seleccionar;
function listar_clientes_para_seleccionar() {
  table_clientes_seleccionar = $("#tabla_lista_clientes").DataTable({
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
    ajax: "controller/clientes/controlador_cliente_listar_seleccionar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
      $($(nRow).find("td")[3]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

$("#tabla_lista_clientes").on("click", ".btnSeleccionarCliente", function () {
  var idCliente = $(this).attr("idCliente");
  // var idCliente = "170";

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "controller/clientes/controlador_traer_datos_cliente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#cbm_origen").val(data[0]["cliente_origen"]).change();
        $("#txt_idCliente").val(data[0]["cliente_id"]);
        $("#txt_documento").val(data[0]["cliente_ci"]);
        $("#txt_nombre").val(data[0]["cliente_nombre"]);
        $("#genero").val(data[0]["cliente_genero"]).change();
        $("#estado_civil")
          .val(
            data[0]["cliente_estado_civil"]
              ? data[0]["cliente_estado_civil"].toUpperCase()
              : ""
          )
          .change();
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_edad_nacimiento").val(data[0]["cliente_edad"]);
        $("#txt_email").val(data[0]["cliente_email"]);
        $("#txt_telefono").val(data[0]["cliente_telefono"]);
        $("#txt_email_opcional").val(data[0]["cliente_email_opcional"]);
        $("#txt_telefono_opcional").val(data[0]["cliente_telefono_opcional"]);
        $("#cbm_provincia").val(data[0]["provincia_id"]).change();
        $("#txt_ciudad").val(data[0]["ciudad_id"]);
        $("#txt_direccion").val(data[0]["cliente_direccion"]);
        $("#txt_ocupacion").val(data[0]["cliente_ocupacion"]);
        $("#cbm_ingreso_mensual").val(data[0]["cliente_ingreso"]).change();
      } else {
        $("#cbm_origen").val("MQP").change();
        $("#txt_idCliente").val("0");
        $("#txt_documento").val("");
        $("#txt_nombre").val("");
        $("#genero").val("").change();
        $("#estado_civil").val("").change();
        $("#txt_fecha_nacimiento").val("");
        $("#txt_edad_nacimiento").val("");
        $("#txt_email").val("");
        $("#txt_telefono").val("");
        $("#txt_email_opcional").val("");
        $("#txt_telefono_opcional").val("");
        $("#cbm_provincia").val("0").change();
        $("#txt_ciudad").val("");
        $("#txt_direccion").val("");
        $("#txt_ocupacion").val("0");
        $("#cbm_ingreso_mensual").val("").change();
      }

      actualizar_edad_fecha_nacimiento();

      $("#modalListarClientes").modal("hide");
    },
  });
});

/*=============================================
  LISTAR EMPLEADOS
  =============================================*/

$(".btnListarEmpleados").click(function () {
  $("#modalListarEmpleados").modal({ backdrop: "static", keyboard: false });
  $("#modalListarEmpleados").modal("show");
  table_empleados_seleccionar.ajax.reload();
});

var table_empleados_seleccionar;
function listar_empleados_para_seleccionar() {
  table_empleados_seleccionar = $("#tabla_lista_empleados").DataTable({
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
    ajax: "controller/empleados/controlador_empleados_listar_seleccionar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[0]).css("text-align", "center");
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

$("#tabla_lista_empleados").on("click", ".btnSeleccionarEmpleado", function () {
  var idEmpleado = $(this).attr("idEmpleado");

  buscar_empleado_id(idEmpleado);
});

function buscar_empleado_id(idEmpleado) {
  var datos = new FormData();

  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/empleados/controlador_traerdatos_empleado.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#txt_idEmpleado").val(data[0]["empleado_id"]);
        $("#txt_vendedor").val(
          data[0]["empleado_nombre"] + " " + data[0]["empleado_apellido"]
        );
      } else {
        $("#txt_idEmpleado").val("0");
        $("#txt_vendedor").val("");
      }

      $("#modalListarEmpleados").modal("hide");
    },
  });
}

$(".listaAdicional").on("change", ".txt_fecha_inicio_contrato", function () {
  var fechaInicio = $(this).val();

  if (fechaInicio) {
    // Parsear fecha en UTC
    var [yearInicio, monthInicio, dayInicio] = fechaInicio
      .split("-")
      .map(Number);
    var fechaInicioObj = new Date(
      Date.UTC(yearInicio, monthInicio - 1, dayInicio)
    );

    // Sumar 1 año
    var fechaFinObj = new Date(fechaInicioObj);
    fechaFinObj.setUTCFullYear(fechaInicioObj.getUTCFullYear() + 1);

    // Ajuste especial para 29 de febrero
    if (
      fechaInicioObj.getUTCMonth() === 1 && // Febrero (mes 1 en UTC)
      fechaInicioObj.getUTCDate() === 29 &&
      fechaFinObj.getUTCMonth() === 2 // Si saltó a marzo
    ) {
      fechaFinObj.setUTCMonth(1); // Fijar a febrero (mes 1)
      fechaFinObj.setUTCDate(28); // Último día de febrero
    }

    // Formatear a YYYY-MM-DD
    var fechaFormateada = [
      fechaFinObj.getUTCFullYear(),
      String(fechaFinObj.getUTCMonth() + 1).padStart(2, "0"),
      String(fechaFinObj.getUTCDate()).padStart(2, "0"),
    ].join("-");

    // $(this)
    //   .parent()
    //   .parent()
    //   .parent()
    //   .find(".txt_fecha_fin_contrato")
    //   .css({ color: "red", border: "2px solid red" });

    // Actualizar el campo
    $(this)
      .parent()
      .parent()
      .parent()
      .find(".txt_fecha_fin_contrato")
      .val(fechaFormateada);
  }
});
