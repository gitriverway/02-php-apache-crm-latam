// function lista1(){

//     $.ajax({
//         url: "controller/clientes/controlador_cliente_listar_asistencia_medica_corporativo_empresarial.php",
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

var tabla_cliente_pymes;
function listar_cliente_pymes() {
  tabla_cliente_pymes = $("#tabla_cliente_pymes").DataTable({
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
    searchPanes: {
      layout: "columns-4",
      cascadePanes: true,
      dtOpts: {
        dom: "tp",
        paging: true,
        pagingType: "numbers",
        searching: false,
      },
    },
    dom: "Plfrtip",
    columnDefs: [
      {
        searchPanes: {
          show: true,
        },
        targets: [1, 3, 8, 10],
      },
      {
        searchPanes: {
          show: false,
        },
        targets: [3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
      },
    ],
    ajax: "controller/clientes/controlador_cliente_listar_asistencia_medica_corporativo_empresarial.php",
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
      $($(nRow).find("td")[9]).css("text-align", "center");
      $($(nRow).find("td")[10]).css("text-align", "center");
      $($(nRow).find("td")[11]).css("text-align", "center");
      $($(nRow).find("td")[12]).css("text-align", "center");
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
      "controller/contratos-clientes-empresariales/controlador_contrato_listar_documento.php?idCliente=" +
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
$("#tabla_cliente_pymes").on("click", ".btnListaContratos", function () {
  var idCliente = $(this).attr("idCliente");

  $("#modal_listar_contratos").modal({ backdrop: "static", keyboard: false });
  $("#modal_listar_contratos").modal("show");
  listar_documentos(idCliente);
});

$("#tabla_lista_contratos").on("click", ".btnImprimirDocumento", function () {
  var documentoRuta = $(this).attr("documentoRuta");
  window.open(documentoRuta, "Documento Contrato", "width=1024,height=1024");
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
    url: "controller/contratos-clientes-empresariales/controlador_documento_emision_eliminar.php",
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
$("#tabla_cliente_pymes").on("click", ".btnListaVendedor", function () {
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
          tabla_cliente_pymes.ajax.reload();
        });
      }
    },
  });
});

/*********************************
EDITAR BAYER PERSONA
*********************************/
$("#tabla_cliente_pymes").on("click", ".btnBayerPersona", function () {
  var idCliente = $(this).attr("idCliente");
  window.location =
    "index.php?ruta=editar-cliente-asistencia-medica-corporativo-empresarial&idCliente=" +
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
        cadena += "<option value='0'>OTROS</option>";
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
  ACTUALIZAR LISTADO COLABORADORES
  =============================================*/

$(".nuevoColaborador").on("change", "input.nombreColaborador", function () {
  listarColaboradores();
});

$(".nuevoColaborador").on("keyup", "input.nombreColaborador", function () {
  listarColaboradores();
});

$(".nuevoColaborador").on("change", "select.generoColaborador", function () {
  listarColaboradores();
});

$(".nuevoColaborador").on(
  "change",
  "input.fecha_nacimiento_colaborador",
  function () {
    listarColaboradores();
  }
);

$(".nuevoColaborador").on("keyup", "input.deducibleColaborador", function () {
  listarColaboradores();
});

/*=============================================
  AGREGANDO COLABORADORES
  =============================================*/

var numProspecto = 0;

$(".btnAgregarColaborador").click(function () {
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

  $(".nuevoColaborador").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridMiembroColaboradores">' +
      "<!-- Parentesco -->" +
      '<div class="col-6 col-md-2 order-md-1 my-1 ' +
      estado +
      ' etiquetaTipoColaborador" id = "etiquetaTipoColaborador' +
      numProspecto +
      '" style="padding-right:0px">' +
      "<label>Parentesco</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-8 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras tipoColaborador" id="tipoColaborador' +
      numProspecto +
      '" name="tipoColaborador' +
      numProspecto +
      '" style="text-transform: uppercase" value="Titular" disabled></input>' +
      "</div>" +
      "</div>" +
      "<!-- Nombre -->" +
      '<div class="col-6 col-md-2 order-md-2 my-1 ' +
      estado +
      ' etiquetaNombreColaborador" id = "etiquetaNombreColaborador' +
      numProspecto +
      '">' +
      "<label>Nombre</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-9 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras nombreColaborador" id="nombreColaborador' +
      numProspecto +
      '" name="nombreColaborador' +
      numProspecto +
      '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Genero -->" +
      '<div class="col-6 col-md-2 order-md-3 my-1 ' +
      estado +
      ' etiquetaGeneroColaborador" id = "etiquetaGeneroColaborador' +
      numProspecto +
      '">' +
      "<label>Genero</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-10 my-1">' +
      '<select class="form-control generoColaborador" id="generoColaborador' +
      numProspecto +
      '" name="generoColaborador' +
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
      ' etiquetaFechaColaborador" id = "etiquetaFechaColaborador' +
      numProspecto +
      '" style="padding-left:0px">' +
      "<label>Fecha Nacimiento</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-11 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="date" class="form-control fecha_nacimiento_colaborador" id="fecha_nacimiento_colaborador' +
      numProspecto +
      '" name="fecha_nacimiento_colaborador' +
      numProspecto +
      '" required>' +
      "</div>" +
      "</div>" +
      "<!-- Deducible -->" +
      '<div class="col-6 col-md-2 order-md-5 my-1 ' +
      estado +
      ' etiquetaDeducibleColaborador" id = "etiquetaDeducibleColaborador' +
      numProspecto +
      '">' +
      "<label>Deducible</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-12 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosDecimal deducibleColaborador" id="deducibleColaborador' +
      numProspecto +
      '" name="deducibleColaborador' +
      numProspecto +
      '" placeholder="INGRESE DEDUCIBLE" autocomplete="off" value = "0"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Agregar -->" +
      '<div class="col-6 col-md-1 order-md-6 my-1 ' +
      estado1 +
      ' etiquetaAgregarDependiente" id = "etiquetaAgregarDependiente' +
      numProspecto +
      '" style="padding-left:0px">' +
      "<label>Dependientes</label>" +
      "</div>" +
      '<div class="col-12 col-md-1 order-md-13 my-1" style="padding-left:0px">' +
      '<button type="button" class="form-control btn btn-primary AgregarDependiente" idColaborador="' +
      numProspecto +
      '"><i class="fa fa-plus"></i></button>' +
      '<input type="hidden" class = "listaFamiliares" id="listaFamiliares' +
      numProspecto +
      '" name="listaFamiliares' +
      numProspecto +
      '">' +
      '<input type="hidden" class = "listaFamiliaresN" id="listaFamiliaresN' +
      numProspecto +
      '" name="listaFamiliaresN' +
      numProspecto +
      '">' +
      "</div>" +
      "<!-- Eliminar -->" +
      '<div class="col-6 col-md-1 order-md-7 my-1 ' +
      estado1 +
      ' etiquetaAccionesColaborador" id = "etiquetaAccionesColaborador' +
      numProspecto +
      '" style="padding-left:0px">' +
      "<label></label>" +
      "</div>" +
      '<div class="col-12 col-md-1 order-md-14 my-1" style="padding-left:0px">' +
      '<button type="button" class="form-control btn btn-danger quitarColaborador" idColaborador="' +
      numProspecto +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );
});

$(".nuevoColaborador").on("click", "button.AgregarDependiente", function () {
  let idColaborador = $(this).attr("idColaborador");
  $("#txt_idColaborador").val(idColaborador);
  $("#modalListarDependientesColaborador").modal({
    backdrop: "static",
    keyboard: false,
  });
  $("#modalListarDependientesColaborador").modal("show");
  $(".nuevoDependiente").empty();
  numSubProspecto = 0;
  Listar_dependientes_colaborador();
});

/*=============================================
  LISTAR DEPENDIENTES DEL COLABORADOR
  =============================================*/

function Listar_dependientes_colaborador() {
  let idColaborador = $("#txt_idColaborador").val();

  var lista = $("#listaFamiliares" + idColaborador).val();

  if (lista.length > 0) {
    auto_agregar_familiares_dependientes(lista);
  }
}

/*=============================================
  AGREGANDO FAMILIAR AUTOMATICAMENTE
  =============================================*/

function auto_agregar_familiares_dependientes(lista) {
  var data = JSON.parse(lista);

  for (let i = 0; i < data.length; i++) {
    if (data[i]["valor_deducible"] > 0) {
      valor = data[i]["valor_deducible"];
    } else {
      valor = 0;
    }
    numSubProspecto++;

    var estado = "";
    var estado1 = "";

    if (numSubProspecto > 1) {
      estado = "d-md-none";
      estado1 = "d-none";
    } else {
      estado = "";
      estado1 = "";
    }

    $(".nuevoDependiente").append(
      '<div class="col-12 my-1">' +
        '<div class="row gridMiembroFamiliares">' +
        "<!-- Parentesco -->" +
        '<div class="col-6 col-md-2 order-md-1 my-1 ' +
        estado +
        ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
        numSubProspecto +
        '" style="padding-right:0px">' +
        "<label>Parentesco</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-7 my-1" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<select class="form-control tipoFamiliar" id="tipoFamiliar' +
        numSubProspecto +
        '" name="tipoFamiliar' +
        numSubProspecto +
        '" required>' +
        '<option value= "">Seleccione...</option>' +
        '<option value= "Conyuge">Conyuge</option>' +
        '<option value= "Hijo/a">Hijo/a</option>' +
        '<option value= "Otro">Otro</option>' +
        '<option value= "Familiar">Familiar</option>' +
        "</select>" +
        "</div>" +
        "</div>" +
        "<!-- Nombre -->" +
        '<div class="col-6 col-md-3 order-md-2 my-1 ' +
        estado +
        ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Nombre</label>" +
        "</div>" +
        '<div class="col-6 col-md-3 order-md-8 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosLetras nombreFamiliar" id="nombreFamiliar' +
        numSubProspecto +
        '" name="nombreFamiliar' +
        numSubProspecto +
        '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase" value = "' +
        data[i]["nombre"] +
        '"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Genero -->" +
        '<div class="col-6 col-md-2 order-md-3 my-1 ' +
        estado +
        ' etiquetaGeneroFamiliar" id = "etiquetaGeneroFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Genero</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-9 my-1">' +
        '<select class="form-control generoFamiliar" id="generoFamiliar' +
        numSubProspecto +
        '" name="generoFamiliar' +
        numSubProspecto +
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
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label>Fecha Nacimiento</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<input type="date" class="form-control fecha_nacimiento" id="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" name="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" value = "' +
        data[i]["fecha_nacimiento"] +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Deducible -->" +
        '<div class="col-6 col-md-2 order-md-5 my-1 ' +
        estado +
        ' etiquetaDeducibleFamiliar" id = "etiquetaDeducibleFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Deducible</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-11 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosDecimal deducibleFamiliar" id="deducibleFamiliar' +
        numSubProspecto +
        '" name="deducibleFamiliar' +
        numSubProspecto +
        '" placeholder="INGRESE DEDUCIBLE" autocomplete="off"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Eliminar -->" +
        '<div class="col-6 col-md-1 order-md-6 my-1 ' +
        estado1 +
        ' etiquetaAcciones" id = "etiquetaAcciones' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label></label>" +
        "</div>" +
        '<div class="col-12 col-md-1 order-md-12 my-1" style="padding-left:0px">' +
        '<button type="button" class="form-control btn btn-danger quitarDependiente" idFamiliar="' +
        numSubProspecto +
        '"><i class="fa fa-times"></i></button>' +
        "</div>" +
        "</div>" +
        "</div>"
    );

    $("#tipoFamiliar" + numSubProspecto)
      .val(data[i]["tipo"])
      .change();
    $("#generoFamiliar" + numSubProspecto)
      .val(data[i]["genero"])
      .change();
    $("#deducibleFamiliar" + numSubProspecto).val(valor);
  }
}

/*=============================================
  AGREGANDO FAMILIAR
  =============================================*/

var numSubProspecto = 0;

$("#modalListarDependientesColaborador").on(
  "click",
  "button.btnAgregarDependiente",
  function () {
    numSubProspecto++;

    var estado = "";
    var estado1 = "";

    if (numSubProspecto > 1) {
      estado = "d-md-none";
      estado1 = "d-none";
    } else {
      estado = "";
      estado1 = "";
    }

    $(".nuevoDependiente").append(
      '<div class="col-12 my-1">' +
        '<div class="row gridMiembroFamiliares">' +
        "<!-- Parentesco -->" +
        '<div class="col-6 col-md-2 order-md-1 my-1 ' +
        estado +
        ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
        numSubProspecto +
        '" style="padding-right:0px">' +
        "<label>Parentesco</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-7 my-1" style="padding-right:0px">' +
        '<div class="input-group">' +
        '<select class="form-control tipoFamiliar" id="tipoFamiliar' +
        numSubProspecto +
        '" name="tipoFamiliar' +
        numSubProspecto +
        '" required>' +
        '<option value= "">Seleccione...</option>' +
        '<option value= "Conyuge">Conyuge</option>' +
        '<option value= "Hijo/a">Hijo/a</option>' +
        '<option value= "Otro">Otro</option>' +
        '<option value= "Familiar">Familiar</option>' +
        "</select>" +
        "</div>" +
        "</div>" +
        "<!-- Nombre -->" +
        '<div class="col-6 col-md-3 order-md-2 my-1 ' +
        estado +
        ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Nombre</label>" +
        "</div>" +
        '<div class="col-6 col-md-3 order-md-8 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosLetras nombreFamiliar" id="nombreFamiliar' +
        numSubProspecto +
        '" name="nombreFamiliar' +
        numSubProspecto +
        '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Genero -->" +
        '<div class="col-6 col-md-2 order-md-3 my-1 ' +
        estado +
        ' etiquetaGeneroFamiliar" id = "etiquetaGeneroFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Genero</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-9 my-1">' +
        '<select class="form-control generoFamiliar" id="generoFamiliar' +
        numSubProspecto +
        '" name="generoFamiliar' +
        numSubProspecto +
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
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label>Fecha Nacimiento</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<input type="date" class="form-control fecha_nacimiento" id="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" name="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Deducible -->" +
        '<div class="col-6 col-md-2 order-md-5 my-1 ' +
        estado +
        ' etiquetaDeducibleFamiliar" id = "etiquetaDeducibleFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Deducible</label>" +
        "</div>" +
        '<div class="col-6 col-md-2 order-md-11 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosDecimal deducibleFamiliar" id="deducibleFamiliar' +
        numSubProspecto +
        '" name="deducibleFamiliar' +
        numSubProspecto +
        '" placeholder="INGRESE DEDUCIBLE" autocomplete="off" value = "0"></input>' +
        "</div>" +
        "</div>" +
        "<!-- Eliminar -->" +
        '<div class="col-6 col-md-1 order-md-6 my-1 ' +
        estado1 +
        ' etiquetaAcciones" id = "etiquetaAcciones' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label></label>" +
        "</div>" +
        '<div class="col-12 col-md-1 order-md-12 my-1" style="padding-left:0px">' +
        '<input type="hidden" class="valor_deducible_prospecto" id="valor_deducible_prospecto' +
        numSubProspecto +
        '" name="valor_deducible_prospecto' +
        numSubProspecto +
        '" value="0">' +
        '<button type="button" class="form-control btn btn-danger quitarDependiente" idFamiliar="' +
        numSubProspecto +
        '"><i class="fa fa-times"></i></button>' +
        "</div>" +
        "</div>" +
        "</div>"
    );
  }
);

/*=============================================
  RECARGAR ETIQUETAS LISTAR COLABORADORES
  =============================================*/

function recargarEtiquetaslistarColaboradores() {
  var accionesColaborador = $(".etiquetaAgregarDependiente");

  var tipo = $(".etiquetaTipoColaborador");

  var nombre = $(".etiquetaNombreColaborador");

  var genero = $(".etiquetaGeneroColaborador");

  var fecha_nacimiento = $(".etiquetaFechaColaborador");

  var deducible = $(".etiquetaDeducibleColaborador");

  var acciones = $(".etiquetaAccionesColaborador");

  for (var i = 0; i < accionesColaborador.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let nombre1 = $(nombre[i]).attr("id");
    let genero1 = $(genero[i]).attr("id");
    let fecha_nacimiento1 = $(fecha_nacimiento[i]).attr("id");
    let deducible1 = $(deducible[i]).attr("id");
    let accionesColaborador1 = $(accionesColaborador[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + deducible1).removeClass("d-md-none");
      $("#" + accionesColaborador1).removeClass("d-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + deducible1).removeClass("d-md-none");
      $("#" + accionesColaborador1).removeClass("d-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + nombre1).addClass("d-md-none");
      $("#" + genero1).addClass("d-md-none");
      $("#" + fecha_nacimiento1).addClass("d-md-none");
      $("#" + deducible1).addClass("d-md-none");
      $("#" + accionesColaborador1).addClass("d-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
  LISTAR COLABORADORES
  =============================================*/

function listarColaboradores() {
  var listaColaboradores = [];

  var tipo = $(".tipoColaborador");

  var nombre = $(".nombreColaborador");

  var genero = $(".generoColaborador");

  var fecha_nacimiento = $(".fecha_nacimiento_colaborador");

  var valor_deducible = $(".deducibleColaborador");

  var lista_dependientes = $(".listaFamiliares");

  for (var i = 0; i < tipo.length; i++) {
    var lista = $(lista_dependientes[i]).val();

    var listar_dependientes = "";

    if (lista.length > 0) {
      listar_dependientes = JSON.parse(lista);
    }

    listaColaboradores.push({
      tipo: $(tipo[i]).val(),
      nombre: $(nombre[i]).val().trim().toUpperCase(),
      genero: $(genero[i]).val(),
      fecha_nacimiento: $(fecha_nacimiento[i]).val(),
      edad: getEdad($(fecha_nacimiento[i]).val()),
      valor_deducible: $(valor_deducible[i]).val(),
      lista_dependientes: listar_dependientes,
    });
  }

  $("#listaColaboradores").val(JSON.stringify(listaColaboradores));
}
/*=============================================
  QUITAR COLABORADOR
  =============================================*/
var idColaborador = [];

localStorage.removeItem("quitarColaborador");

$(".nuevoColaborador").on("click", "button.quitarColaborador", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idColaborador = $(this).attr("idColaborador");

  /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

  if (localStorage.getItem("quitarColaborador") == null) {
    idColaborador = [];
  } else {
    idColaborador.concat(localStorage.getItem("quitarColaborador"));
  }

  idColaborador.push({
    idColaborador: idColaborador,
  });

  localStorage.setItem("quitarColaborador", JSON.stringify(idColaborador));

  numProspecto--;

  if ($(".nuevoColaborador").children().length == 0) {
    $("#listaColaboradores").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarColaboradores();
    recargarEtiquetaslistarColaboradores();
  }
});

/*=============================================
  LISTAR COLABORADORES
  =============================================*/

function listarDependientes(idColaborador) {
  var listaDependintes = [];

  var tipo = $(".tipoFamiliar");

  var nombre = $(".nombreFamiliar");

  var genero = $(".generoFamiliar");

  var fecha_nacimiento = $(".fecha_nacimiento");

  var valor_deducible = $(".deducibleFamiliar");

  for (var i = 0; i < tipo.length; i++) {
    listaDependintes.push({
      tipo: $(tipo[i]).val().trim(),
      nombre: $(nombre[i]).val().trim().toUpperCase(),
      genero: $(genero[i]).val().trim(),
      fecha_nacimiento: $(fecha_nacimiento[i]).val().trim(),
      edad: getEdad($(fecha_nacimiento[i]).val()),
      valor_deducible: $(valor_deducible[i]).val().trim(),
    });
  }

  $("#listaFamiliares" + idColaborador).val(JSON.stringify(listaDependintes));
}

function Registrar_Dependientes_Colaborador() {
  let idColaborador = $("#txt_idColaborador").val();
  listarDependientes(idColaborador);

  var lista = $("#listaFamiliares" + idColaborador).val();

  var cont = 0;

  if (lista.length > 0) {
    var data = JSON.parse(lista);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var tipo_dependiente = data[i]["tipo"];
        var genero_dependiente = data[i]["genero"];
        var edad_dependiente = data[i]["edad"];
        var valor_deducible_dependiente = data[i]["valor_deducible"];
        if (
          tipo_dependiente.length == 0 ||
          genero_dependiente.length == 0 ||
          edad_dependiente == null ||
          valor_deducible_dependiente.length == 0
        ) {
          cont++;
        }
      }
    }
  }

  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de familiares",
      "warning"
    );
  } else {
    $("#modalListarDependientesColaborador").modal("hide");
  }
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

/*********************************
  BLOQUE PARA CARGAR DATOS CLIENTE
  *********************************/

function cargar_datos_cliente() {
  var idCliente = $("#txt_idBayer").val();

  var datos = new FormData();

  datos.append("idCliente", idCliente);

  $.ajax({
    url: "controller/bayer-persona-empresarial/controlador_traer_datos_cliente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        if (data[0]["categoria_id"] == 6) {
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
          $("#txt_telefono").val(data[0]["cliente_telefono"]);
          $("#txt_email").val(data[0]["cliente_email"]);
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
          $("#txt_numero_contrato").val(data[0]["contrato_numero"]);
          $("#txt_fecha_inicio_contrato").val(data[0]["contrato_fecha_inicio"]);
          $("#txt_fecha_fin_contrato").val(data[0]["contrato_fecha_fin"]);

          $("#cbm_estado_bayer").val(data[0]["cliente_estado_bayer"]).change();

          $("#listaColaboradores").val(data[0]["cliente_familiares"]);

          $("#listaVehiculos").val(data[0]["cliente_vehiculos"]);

          $("#cantidadDocumentos").val(0);

          // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
          $(".valores_emision").number(true, 2);

          agregar_auto_Colaboradores();

          agregar_auto_observaciones();
        } else {
          return (window.location =
            "clientes-asistencia-medica-corporativo-empresarial");
        }
      } else {
        return (window.location =
          "clientes-asistencia-medica-corporativo-empresarial");
      }
    },
  });
}

function agregar_auto_Colaboradores() {
  var lista = $("#listaColaboradores").val();

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
      var lista_dependiente = data[i]["lista_dependientes"];

      var listar_dependientes = "";

      if (lista_dependiente.length > 0) {
        listar_dependientes = JSON.stringify(lista_dependiente);
      }

      $(".nuevoColaborador").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridMiembroColaboradores">' +
          "<!-- Parentesco -->" +
          '<div class="col-6 col-md-2 order-md-1 my-1 ' +
          estado +
          ' etiquetaTipoColaborador" id = "etiquetaTipoColaborador' +
          numProspecto +
          '" style="padding-right:0px">' +
          "<label>Parentesco</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-7 my-1" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras tipoColaborador" id="tipoColaborador' +
          numProspecto +
          '" name="tipoColaborador' +
          numProspecto +
          '" style="text-transform: uppercase" disabled></input>' +
          "</div>" +
          "</div>" +
          "<!-- Nombre -->" +
          '<div class="col-6 col-md-2 order-md-2 my-1 ' +
          estado +
          ' etiquetaNombreColaborador" id = "etiquetaNombreColaborador' +
          numProspecto +
          '">' +
          "<label>Nombre</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-8 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras nombreColaborador" id="nombreColaborador' +
          numProspecto +
          '" name="nombreColaborador' +
          numProspecto +
          '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["nombre"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Genero -->" +
          '<div class="col-6 col-md-2 order-md-3 my-1 ' +
          estado +
          ' etiquetaGeneroColaborador" id = "etiquetaGeneroColaborador' +
          numProspecto +
          '">' +
          "<label>Genero</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-9 my-1">' +
          '<select class="form-control generoColaborador" id="generoColaborador' +
          numProspecto +
          '" name="generoColaborador' +
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
          ' etiquetaFechaColaborador" id = "etiquetaFechaColaborador' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label>Fecha Nacimiento</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="date" class="form-control fecha_nacimiento_colaborador" id="fecha_nacimiento_colaborador' +
          numProspecto +
          '" name="fecha_nacimiento_colaborador' +
          numProspecto +
          '" value= "' +
          data[i]["fecha_nacimiento"] +
          '" required>' +
          "</div>" +
          "</div>" +
          "<!-- Deducible -->" +
          '<div class="col-6 col-md-2 order-md-5 my-1 ' +
          estado +
          ' etiquetaDeducibleColaborador" id = "etiquetaDeducibleColaborador' +
          numProspecto +
          '">' +
          "<label>Deducible</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-11 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosDecimal deducibleColaborador" id="deducibleColaborador' +
          numProspecto +
          '" name="deducibleColaborador' +
          numProspecto +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Agregar -->" +
          '<div class="col-6 col-md-1 order-md-5 my-1 ' +
          estado1 +
          ' etiquetaAgregarDependiente" id = "etiquetaAgregarDependiente' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label>Dependientes</label>" +
          "</div>" +
          '<div class="col-12 col-md-1 order-md-11 my-1" style="padding-left:0px">' +
          '<button type="button" class="form-control btn btn-primary AgregarDependiente" idColaborador="' +
          numProspecto +
          '"><i class="fa fa-plus"></i></button>' +
          '<input type="hidden" class = "listaFamiliares" id="listaFamiliares' +
          numProspecto +
          '" name="listaFamiliares' +
          numProspecto +
          '">' +
          "</div>" +
          "<!-- Eliminar -->" +
          '<div class="col-6 col-md-1 order-md-6 my-1 ' +
          estado1 +
          ' etiquetaAccionesColaborador" id = "etiquetaAccionesColaborador' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label></label>" +
          "</div>" +
          '<div class="col-12 col-md-1 order-md-12 my-1" style="padding-left:0px">' +
          '<button type="button" class="form-control btn btn-danger quitarColaborador" idColaborador="' +
          numProspecto +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoColaborador" + numProspecto).val(data[i]["tipo"]);
      $("#generoColaborador" + numProspecto)
        .val(data[i]["genero"])
        .change();
      $("#deducibleColaborador" + numProspecto).val(valor);
      $("#listaFamiliares" + numProspecto).val(listar_dependientes);
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
  $("#cardDependientes").append(
    '<div class="overlay dark" id="overlayDependientes"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardContrato").append(
    '<div class="overlay dark" id="overlayContrato"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_asistencia_medica() {
  $("#overlayBayer").remove();
  $("#overlayPersonal").remove();
  $("#overlayDependientes").remove();
  $("#overlayContrato").remove();
}

/*********************************
   MODIFICAR DATOS CLIENTE
   *********************************/
function Modificar_Cliente() {
  listarColaboradores();
  listarDocumentos();

  var idBayer = $("#txt_idBayer").val();
  var origen = $("#cbm_origen").val();
  var categoria = $("#txt_idcategoria").val();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre = $("#txt_nombre").val().trim().toUpperCase();
  var telefono = $("#txt_telefono").val().trim();
  var email = $("#txt_email").val().trim();
  var provincia = $("#cbm_provincia").val();
  var ciudad = $("#txt_ciudad").val().trim().toUpperCase();
  var direccion = $("#txt_direccion").val().trim().toUpperCase();
  var ocupacion = $("#txt_ocupacion").val().trim().toUpperCase();
  var valor_ingreso = $("#cbm_ingreso_mensual").val().trim();
  var valor_asegurado = $("#txt_valor_asegurado").val().trim();
  var prima_neta = $("#txt_prima_neta").val().trim();
  var prima_comisionable = $("#txt_prima_comisionable").val().trim();
  var prima_total = $("#txt_prima_total").val().trim();
  var tipo_pago = $("#cbm_tipo_pago").val();
  var forma_pago = $("#cbm_forma_pago").val();
  var estado_bayer = $("#cbm_estado_bayer").val();
  var listaColaboradores = $("#listaColaboradores").val();
  var listaVehiculos = $("#listaVehiculos").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();

  /**=============================
     BLOQUE PARA DATOS DEL CONTRATO
     * =============================
     */
  var numero_contrato = $("#txt_numero_contrato").val().trim();
  var fecha_emision = $("#txt_fecha_inicio_contrato").val().trim();
  var fecha_fin = $("#txt_fecha_fin_contrato").val().trim();

  /**============================
     BLOQUE PARA CARGAR DOCUMENTOs
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
  var documento_11;
  var documento_12;
  var cantidad = $("#cantidadDocumentos").val();

  var cont = 0;

  if (listaColaboradores.length > 0) {
    var data = JSON.parse(listaColaboradores);
    if (data.length > 0) {
      for (var i = 0; i < data.length; i++) {
        var tipo = data[i]["tipo"];
        var genero_dependiente = data[i]["genero"];
        var edad = data[i]["edad"];
        var valor_deducible = data[i]["valor_deducible"];
        if (
          tipo.length == 0 ||
          genero_dependiente.length == 0 ||
          edad == null ||
          valor_deducible.length == 0
        ) {
          cont++;
        }
      }
    }
  }
  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de familiares",
      "warning"
    );
  }

  if (idCliente.length == 0) {
    idCliente = 0;
  }

  if (
    origen.length == 0 ||
    categoria.length == 0 ||
    proveedor.length == 0 ||
    idProducto.length == 0 ||
    cedula.length == 0 ||
    nombre.length == 0 ||
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

  var nombre_documento_11 = $("#txt_nombre_documento_11").val();
  var archivo11 = $("#txt_documento_11").val();
  var extension_11 = archivo11.split(".").pop();
  documento_11 = $("#txt_documento_11")[0].files[0];

  var nombre_documento_12 = $("#txt_nombre_documento_12").val();
  var archivo12 = $("#txt_documento_12").val();
  var extension_12 = archivo12.split(".").pop();
  documento_12 = $("#txt_documento_12")[0].files[0];

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
  datos.append("telefono", telefono);
  datos.append("email", email);
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
  datos.append("listaColaboradores", listaColaboradores);
  datos.append("listaVehiculos", listaVehiculos);
  datos.append("listaObservaciones", listaObservaciones);
  datos.append("fecha_seguimiento", fecha_seguimiento);

  /**============================
     * ===VALORES DEL CONTRATO=====
     ==============================*/

  datos.append("numero_contrato", numero_contrato);
  datos.append("fecha_emision", fecha_emision);
  datos.append("fecha_fin", fecha_fin);

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
  datos.append("nombre_documento_11", nombre_documento_11);
  datos.append("documento_11", documento_11);
  datos.append("extension_11", extension_11);
  datos.append("nombre_documento_12", nombre_documento_12);
  datos.append("documento_12", documento_12);
  datos.append("extension_12", extension_12);
  datos.append("cantidad", cantidad);

  $.ajax({
    url: "controller/clientes/controlador_cliente_asistencia_medica_corporativo_empresarial_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        if (data[0]["valor"] == 1) {
          Swal.fire(
            "Mensaje De Confirmacion",
            "Datos correctamente, Actualizado Cliente",
            "success"
          ).then((value) => {
            window.location =
              "clientes-asistencia-medica-corporativo-empresarial";
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
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_email").val(data[0]["cliente_email"]);
        $("#txt_telefono").val(data[0]["cliente_telefono"]);
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
        $("#txt_fecha_nacimiento").val("");
        $("#txt_email").val("");
        $("#txt_telefono").val("");
        $("#cbm_provincia").val("0").change();
        $("#txt_ciudad").val("");
        $("#txt_direccion").val("");
        $("#txt_ocupacion").val("0");
        $("#cbm_ingreso_mensual").val("").change();
      }

      $("#modalListarClientes").modal("hide");
    },
  });
});
