// function lista1(){

//     $.ajax({
//         url: "controller/prospectos-empresariales/controlador_prospecto_listar.php",
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
  $("#tabla_prospecto_empresarial").removeClass("nowrap");
  $("#tabla_prospecto_empresarial").addClass("dt-responsive");
} else {
  $("#tabla_prospecto_empresarial").removeClass("dt-responsive");
  $("#tabla_prospecto_empresarial").addClass("nowrap");
}

var table_prospecto_empresarial;
function listar_prospecto_empresarial() {
  table_prospecto_empresarial = $("#tabla_prospecto_empresarial").DataTable({
    scrollX: true,
    ordering: false,
    destroy: true,
    processing: true,
    //     // "dom": "Plfrtip",
    dom: "PBfrtip", // 'P' para SearchPanes
    select: true, // Activa Select
    ajax: "controller/prospectos-empresariales/controlador_prospecto_listar.php",
    searchPanes: {
      cascadePanes: true,
      layout: "columns-7",
      dtOpts: {
        paging: true,
        pagingType: "numbers",
        searching: false,
      },
    },
    columnDefs: [
      {
        targets: [3, 4, 10, 12, 14, 15, 16],
        searchPanes: { show: true },
      },
      {
        targets: [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 13, 17],
        searchPanes: { show: false },
      },
    ],

    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 17; i++) {
        $($(nRow).find("td")[i]).css("text-align", "center");
      }
    },
    language: idioma_espanol,
  });

  $("#btnListaVendedor").removeClass("btnListaVendedor");
  $("#btnListaVendedor").addClass("btnListaVendedor");
}

var table_vendedor;
function listar_vendedores() {
  table_vendedor = $("#tabla_lista_vendedores").DataTable({
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
    ajax: "controller/usuarios/controlador_asignar_vendedor_listar.php",
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      $($(nRow).find("td")[1]).css("text-align", "center");
      $($(nRow).find("td")[2]).css("text-align", "center");
    },
    language: idioma_espanol,
  });
}

/*********************************
 ABRI MODAL ASIGNAR VENDEDOR
 *********************************/
// $("#tabla_prospecto_empresarial").on("click", ".btnListaVendedor", function () {
//   $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
//   $("#modal_asignar_vendedor").modal("show");

//   llenarListaCkeckAsignar();
// });

$("#btnListaVendedor").on("click", function () {
  $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
  $("#modal_asignar_vendedor").modal("show");

  llenarListaCkeckAsignar();
});

$("#tabla_lista_vendedores").on("click", ".btnAsignarVendedor", function () {
  var idEmpleado = $(this).attr("idEmpleado");

  if (listarCheckAsignar.length > 0) {
    for (let i = 0; i < listarCheckAsignar.length; i++) {
      let idProspecto = listarCheckAsignar[i];
      modificarVendedor(idProspecto, idEmpleado);
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Error al actualizar",
      text: "¡No hay prospectos seleccionados para asignar vendedor!",
      confirmButtonText: "¡Cerrar!",
    });
  }
});

function modificarVendedor(idProspecto, idEmpleado) {
  var datos = new FormData();
  datos.append("idProspecto", idProspecto);
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/prospectos-empresariales/controlador_modificar_vendedor_asignado_a_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.seller_assigned', 'The seller has been assigned'),
          "success"
        ).then((value) => {
          $("#modal_asignar_vendedor").modal("hide");
          table_prospecto_empresarial.ajax.reload();
        });
      }
    },
  });
}
/*********************************
ABRI MODAL MODIFICAR ESTADO BAYER
*********************************/
$("#tabla_prospecto_empresarial").on("click", ".btnEstadoBayer", function () {
  var idProspecto = $(this).attr("idProspecto");
  $("#txt_idProspecto").val(idProspecto);

  $("#modal_estado_bayer").modal({ backdrop: "static", keyboard: false });
  $("#modal_estado_bayer").modal("show");

  $("#cbm_estado_bayer").val($(this).attr("estadoBayer")).change();
});

function Modificar_Estado_Bayer_Cliente() {
  var idProspecto = $("#txt_idProspecto").val();
  var estadoBayer = $("#cbm_estado_bayer").val();

  var datos = new FormData();
  datos.append("idProspecto", idProspecto);
  datos.append("estadoBayer", estadoBayer);

  $.ajax({
    url: "controller/prospectos-empresariales/controlador_modificar_estado_bayer_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta > 0) {
        if (estadoBayer == "INTERESADO") {
          $("#modal_estado_bayer").modal("hide");
          window.location =
            "index.php?ruta=editar-prospecto-empresarial&idProspecto=" +
            idProspecto;
        } else {
          $("#modal_estado_bayer").modal("hide");
          table_prospecto_empresarial.ajax.reload();
        }
      }
    },
  });
}

/*********************************
EDITAR BAYER PERSONA
*********************************/
$("#tabla_prospecto_empresarial").on("click", ".btnBayerPersona", function () {
  var idProspecto = $(this).attr("idProspecto");
  window.location =
    "index.php?ruta=editar-prospecto-empresarial&idProspecto=" + idProspecto;
});

/*********************************
BLOQUE PARA CREAR NUEVO PROSPECTO
*********************************/
/*********************************
LISTAR COMBO CATEGORIA
*********************************/
function listar_combo_categoria() {
  $.ajax({
    url: "controller/categorias/controlador_combo_categoria_empresarial_listar.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);
      var cadena = "";
      if (data.length > 0) {
        cadena += "<option value=''>" + t('messages.select_option', 'Select..') + "</option>";
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
        cadena += "<option value=''>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
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
        cadena += "<option value='0'>" + t('messages.select_option', 'Select..') + "</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option  value='" +
            data[i]["proveedor_id"] +
            "'>" +
            data[i]["proveedor_descripcion"] +
            "</option>";
        }
      } else {
        cadena += "<option value=''>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
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
        cadena += "<option value='0'>" + t('messages.select_option', 'Select..') + "</option>";
        for (var i = 0; i < data.length; i++) {
          cadena +=
            "<option value='" +
            data[i]["provincia_id"] +
            "'>" +
            data[i]["provincia_descripcion"] +
            "</option>";
        }
      } else {
        cadena += "<option value=''>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
      }
      $(".cbm_provincia").html(cadena);
    },
  });
}

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
      '<div class="col-6 col-md-2 order-md-7 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras tipoColaborador" id="tipoColaborador' +
      numProspecto +
      '" name="tipoColaborador' +
      numProspecto +
      '" style="text-transform: uppercase" value="Titular" disabled></input>' +
      "</div>" +
      "</div>" +
      "<!-- Nombre -->" +
      '<div class="col-6 col-md-3 order-md-2 my-1 ' +
      estado +
      ' etiquetaNombreColaborador" id = "etiquetaNombreColaborador' +
      numProspecto +
      '">' +
      "<label>Nombre</label>" +
      "</div>" +
      '<div class="col-6 col-md-3 order-md-8 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras nombreColaborador" id="nombreColaborador' +
      numProspecto +
      '" name="nombreColaborador' +
      numProspecto +
      '" placeholder="' + t('messages.enter_name', 'ENTER NAME') + '" autocomplete="off" style="text-transform: uppercase"></input>' +
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
      '<option value="">' + t('messages.select_option_uppercase', 'SELECT...') + '</option>' +
      '<option value="masculino">Masculino</option>' +
      '<option value="femenino">Femenino</option>' +
      "</select>" +
      "</div>" +
      "<!-- Fecha de Nacimiento -->" +
      '<div class="col-6 col-md-3 order-md-4 my-1 ' +
      estado +
      ' etiquetaFechaColaborador" id = "etiquetaFechaColaborador' +
      numProspecto +
      '" style="padding-left:0px">' +
      "<label>Fecha Nacimiento</label>" +
      "</div>" +
      '<div class="col-6 col-md-3 order-md-10 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="date" class="form-control fecha_nacimiento_colaborador" id="fecha_nacimiento_colaborador' +
      numProspecto +
      '" name="fecha_nacimiento_colaborador' +
      numProspecto +
      '" required>' +
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
      '<input type="hidden" class = "listaFamiliaresN" id="listaFamiliaresN' +
      numProspecto +
      '" name="listaFamiliaresN' +
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
      '<input type="hidden" class="valor_deducible_colaborador" id="valor_deducible_colaborador' +
      numProspecto +
      '" name="valor_deducible_colaborador' +
      numProspecto +
      '" value="0">' +
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
        '<div class="col-6 col-md-2 order-md-6 my-1" style="padding-right:0px">' +
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
        '<div class="col-6 col-md-4 order-md-2 my-1 ' +
        estado +
        ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Nombre</label>" +
        "</div>" +
        '<div class="col-6 col-md-4 order-md-7 my-1">' +
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
        '<div class="col-6 col-md-2 order-md-8 my-1">' +
        '<select class="form-control generoFamiliar" id="generoFamiliar' +
        numSubProspecto +
        '" name="generoFamiliar' +
        numSubProspecto +
        '" required>' +
        '<option value="">' + t('messages.select_option_uppercase', 'SELECT...') + '</option>' +
        '<option value="masculino">Masculino</option>' +
        '<option value="femenino">Femenino</option>' +
        "</select>" +
        "</div>" +
        "<!-- Fecha de Nacimiento -->" +
        '<div class="col-6 col-md-3 order-md-4 my-1 ' +
        estado +
        ' etiquetaFechaNacimiento" id = "etiquetaFechaNacimiento' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label>Fecha Nacimiento</label>" +
        "</div>" +
        '<div class="col-6 col-md-3 order-md-9 my-1" style="padding-left:0px">' +
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
        "<!-- Eliminar -->" +
        '<div class="col-6 col-md-1 order-md-5 my-1 ' +
        estado1 +
        ' etiquetaAcciones" id = "etiquetaAcciones' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label></label>" +
        "</div>" +
        '<div class="col-12 col-md-1 order-md-10 my-1" style="padding-left:0px">' +
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

    $("#tipoFamiliar" + numSubProspecto)
      .val(data[i]["tipo"])
      .change();
    $("#generoFamiliar" + numSubProspecto)
      .val(data[i]["genero"])
      .change();
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
        '<div class="col-6 col-md-2 order-md-6 my-1" style="padding-right:0px">' +
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
        '<div class="col-6 col-md-4 order-md-2 my-1 ' +
        estado +
        ' etiquetaNombreFamiliar" id = "etiquetaNombreFamiliar' +
        numSubProspecto +
        '">' +
        "<label>Nombre</label>" +
        "</div>" +
        '<div class="col-6 col-md-4 order-md-7 my-1">' +
        '<div class="input-group">' +
        '<input type="text" class="form-control validarNumerosLetras nombreFamiliar" id="nombreFamiliar' +
        numSubProspecto +
        '" name="nombreFamiliar' +
        numSubProspecto +
        '" placeholder="' + t('messages.enter_name', 'ENTER NAME') + '" autocomplete="off" style="text-transform: uppercase"></input>' +
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
        '<div class="col-6 col-md-2 order-md-8 my-1">' +
        '<select class="form-control generoFamiliar" id="generoFamiliar' +
        numSubProspecto +
        '" name="generoFamiliar' +
        numSubProspecto +
        '" required>' +
        '<option value="">' + t('messages.select_option_uppercase', 'SELECT...') + '</option>' +
        '<option value="masculino">Masculino</option>' +
        '<option value="femenino">Femenino</option>' +
        "</select>" +
        "</div>" +
        "<!-- Fecha de Nacimiento -->" +
        '<div class="col-6 col-md-3 order-md-4 my-1 ' +
        estado +
        ' etiquetaFechaNacimiento" id = "etiquetaFechaNacimiento' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label>Fecha Nacimiento</label>" +
        "</div>" +
        '<div class="col-6 col-md-3 order-md-9 my-1" style="padding-left:0px">' +
        '<div class="input-group">' +
        '<input type="date" class="form-control fecha_nacimiento" id="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" name="fecha_nacimiento_Familiar' +
        numSubProspecto +
        '" required>' +
        "</div>" +
        "</div>" +
        "<!-- Eliminar -->" +
        '<div class="col-6 col-md-1 order-md-5 my-1 ' +
        estado1 +
        ' etiquetaAcciones" id = "etiquetaAcciones' +
        numSubProspecto +
        '" style="padding-left:0px">' +
        "<label></label>" +
        "</div>" +
        '<div class="col-12 col-md-1 order-md-10 my-1" style="padding-left:0px">' +
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

  var acciones = $(".etiquetaAccionesColaborador");

  for (var i = 0; i < accionesColaborador.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let nombre1 = $(nombre[i]).attr("id");
    let genero1 = $(genero[i]).attr("id");
    let fecha_nacimiento1 = $(fecha_nacimiento[i]).attr("id");
    let accionesColaborador1 = $(accionesColaborador[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + accionesColaborador1).removeClass("d-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + accionesColaborador1).removeClass("d-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + nombre1).addClass("d-md-none");
      $("#" + genero1).addClass("d-md-none");
      $("#" + fecha_nacimiento1).addClass("d-md-none");
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

  var valor_deducible = $(".valor_deducible_colaborador");

  var lista_dependientes = $(".listaFamiliares");

  for (var i = 0; i < tipo.length; i++) {
    var lista = $(lista_dependientes[i]).val();

    var listar_dependientes = "";

    if (lista.length > 0) {
      listar_dependientes = JSON.parse(lista);
    }

    listaColaboradores.push({
      tipo: $(tipo[i]).val(),
      nombre: $(nombre[i]).val().toUpperCase(),
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

  // localStorage.setItem("quitarColaborador", JSON.stringify(idColaborador));

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

  var valor_deducible = $(".valor_deducible_prospecto");

  for (var i = 0; i < tipo.length; i++) {
    listaDependintes.push({
      tipo: $(tipo[i]).val(),
      nombre: $(nombre[i]).val().toUpperCase(),
      genero: $(genero[i]).val(),
      fecha_nacimiento: $(fecha_nacimiento[i]).val(),
      edad: getEdad($(fecha_nacimiento[i]).val()),
      valor_deducible: $(valor_deducible[i]).val(),
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
        if (
          tipo_dependiente.length == 0 ||
          genero_dependiente.length == 0 ||
          edad_dependiente == null
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
      t('messages.warning', 'Warning Message'),
      t('messages.fill_observation', 'Fill in the observation'),
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
      observacion: $(observacion[i]).text(),
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
  LIMPIAR LOS REGISTROS
  *********************************/
function LimpiarRegistro() {
  $(".nuevoColaborador").empty();
  $(".nuevaObservacion").empty();
  $("#listaColaboradores").val("");
  $("#listaVehiculos").val("");
  $("#listaObservaciones").val("");
  $("#cbm_origen").val("").change();
  $("#cbm_proveedor").val("").change();
  $("#txt_planes").val("");
  $("#txt_documento").val("");
  $("#txt_nombre").val("");
  $("#txt_telefono").val("");
  $("#txt_email").val("");
  $("#cbm_provincia").val("").change();
  $("#txt_direccion").val();
  $("#txt_ocupacion").val();
  $("#cbm_ingreso_mensual").val();
}

function crear_overlay_prospecto() {
  $("#cardBayer").append(
    '<div class="overlay dark" id="overlayBayer"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardPersonal").append(
    '<div class="overlay dark" id="overlayPersonal"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
  $("#cardDependientes").append(
    '<div class="overlay dark" id="overlayDependientes"><i class="fas fa-2x fa-sync fa-spin"></i></div>'
  );
}
function eliminar_overlay_prospecto() {
  $("#overlayBayer").remove();
  $("#overlayPersonal").remove();
  $("#overlayDependientes").remove();
}
/*********************************
   REGISTRAR UN NUEVO CLIENTE
   *********************************/
function Registrar_Cliente() {
  listarColaboradores();

  var origen = $("#cbm_origen").val();
  var categoria = $("#cbm_categoria").val();
  var nuevo_categoria = $("#txt_nuevo_categoria").val().toUpperCase();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre_prospecto = $("#txt_nombre").val().toUpperCase();
  var telefono = $("#txt_telefono").val();
  var email = $("#txt_email").val();
  var provincia = $("#cbm_provincia").val();
  var ciudad = $("#txt_ciudad").val().toUpperCase();
  var direccion = $("#txt_direccion").val().toUpperCase();
  var ocupacion = $("#txt_ocupacion").val().toUpperCase();
  var valor_ingreso = $("#cbm_ingreso_mensual").val();
  var valor_asegurado = $("#txt_valor_asegurado").val();
  var prima_neta = $("#txt_prima_neta").val();
  var prima_comisionable = $("#txt_prima_comisionable").val();
  var prima_total = $("#txt_prima_total").val();
  var tipo_pago = $("#cbm_tipo_pago").val();
  var forma_pago = $("#cbm_forma_pago").val();
  var estado_bayer = $("#cbm_estado_bayer").val();
  var listaColaboradores = $("#listaColaboradores").val();
  var listaVehiculos = $("#listaVehiculos").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();

  var cont_bayerpersonas = 0;
  var cont = 0;
  var cont1 = 0;

  if (idCliente.length == 0) {
    idCliente = 0;
  }

  if (origen.length == 0 || origen == null) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_origin', 'Fill in the origin field'),
      "warning"
    );
  }

  if (categoria.length == 0 || categoria == null) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_branch', 'Fill in the Branch field'),
      "warning"
    );
  }

  if (categoria == 0 && nuevo_categoria.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_new_branch', 'Fill in the new Branch field'),
      "warning"
    );
  }

  if (nombre_prospecto.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_prospect_name', 'Fill in the prospect name field'),
      "warning"
    );
  }

  if (provincia < 1) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_province', 'Fill in the province field'),
      "warning"
    );
  }

  if (cedula.length < 10 && estado_bayer == "CONTRATADO") {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.enter_valid_id', 'Enter valid ID Card and/or RUC number'),
      "warning"
    );
  }

  if (telefono.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_phone', 'Fill in the prospect phone field'),
      "warning"
    );
  }

  if (estado_bayer.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_prospect_status', 'Fill in the prospect status'),
      "warning"
    );
  }

  if (estado_bayer == "CONTRATADO") {
    if (
      origen.length == 0 ||
      categoria.length == 0 ||
      proveedor.length == 0 ||
      idProducto.length == 0 ||
      cedula.length == 0 ||
      nombre_prospecto.length == 0 ||
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
      cont_bayerpersonas++;
    }

    if (listaColaboradores.length > 0) {
      var data = JSON.parse(listaColaboradores);
      if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          var tipo_dependiente = data[i]["tipo"];
          var genero_dependiente = data[i]["genero"];
          var edad_dependiente = data[i]["edad"];
          if (
            tipo_dependiente.length == 0 ||
            genero_dependiente.length == 0 ||
            edad_dependiente == null
          ) {
            cont++;
          }
        }
      }
    }

    if (listaVehiculos.length > 0) {
      var data1 = JSON.parse(listaVehiculos);
      if (data1.length > 0) {
        for (var i = 0; i < data1.length; i++) {
          var tipo_vehiculo = data1[i]["tipo"];
          var marca = data1[i]["marca"];
          var modelo = data1[i]["modelo"];
          var ano = data1[i]["ano"];
          var edad_vehiculo = data1[i]["edad"];
          var monto = data1[i]["monto"];
          if (
            tipo_vehiculo.length == 0 ||
            marca.length == 0 ||
            modelo.length == 0 ||
            ano.length == 0 ||
            edad_vehiculo == null ||
            monto.length == 0
          ) {
            cont1++;
          }
        }
      }
    }
  }

  if (cont_bayerpersonas > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios",
      "warning"
    );
  }

  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de familiares",
      "warning"
    );
  }

  if (cont1 > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de vehiculos",
      "warning"
    );
  }

  crear_overlay_prospecto();

  var datos = new FormData();

  datos.append("origen", origen);
  datos.append("categoria", categoria);
  datos.append("nuevo_categoria", nuevo_categoria);
  datos.append("proveedor", proveedor);
  datos.append("idProducto", idProducto);
  datos.append("idCliente", idCliente);
  datos.append("cedula", cedula);
  datos.append("nombre_prospecto", nombre_prospecto);
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

  $.ajax({
    url: "controller/prospectos-empresariales/controlador_prospecto_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);

      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.new_prospect_registered', 'Data correctly, New Prospect Registered'),
          "success"
        ).then((value) => {
          window.location = "prospecto-asignado-empresarial";
        });
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
      eliminar_overlay_prospecto();
    },
  });
}

/*********************************
  BLOQUE PARA EDITAR PROSPECTO
  *********************************/
/*********************************
  BLOQUE PARA CARGAR DATOS PROSPECTO
  *********************************/
function cargar_datos_prospecto() {
  var idProspecto = $("#txt_idProspecto").val();

  var datos = new FormData();

  datos.append("idProspecto", idProspecto);

  $.ajax({
    url: "controller/prospectos-empresariales/controlador_traer_datos_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#txt_idEmpleado").val(data[0]["empleado_id"]);
        $("#txt_vendedor").val(data[0]["empleado_nombre"]);
        $("#cbm_origen").val(data[0]["cliente_origen"]).change();
        $("#txt_origen_web").val(data[0]["origen_cotizador"]);
        $("#cbm_categoria").val(data[0]["categoria_id"]).change();

        if (data[0]["proveedor_id"] != 0) {
          $("#cbm_proveedor").val(data[0]["proveedor_id"]).change();
        }
        $("#txt_planes").val(data[0]["producto_id"]);
        $("#txt_idCliente").val(data[0]["cliente_id"]);
        $("#txt_documento").val(data[0]["cliente_ci"]);
        $("#txt_nombre").val(data[0]["cliente_nombre"]);
        $(".genero").val(data[0]["cliente_genero"]).change();
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_telefono").val(data[0]["cliente_telefono"]);
        $("#txt_email").val(data[0]["cliente_email"]);
        $("#cbm_provincia").val(data[0]["provincia_id"]).change();
        $("#txt_ciudad").val(data[0]["ciudad_id"]);
        $("#txt_direccion").val(data[0]["cliente_direccion"]);
        $("#txt_ocupacion").val(data[0]["cliente_ocupacion"]);
        $("#cbm_ingreso_mensual").val(data[0]["cliente_ingreso"]).change();
        $("#txt_valor_asegurado").val(data[0]["cliente_valor_asegurado"]);
        $("#txt_prima_neta").val(data[0]["cliente_prima_neta"]);
        $("#txt_prima_comisionable").val(data[0]["cliente_prima_comisionable"]);
        $("#txt_prima_total").val(data[0]["cliente_prima_total"]);
        $("#cbm_tipo_pago").val(data[0]["cliente_tipo_pago"]).change();
        $("#cbm_forma_pago").val(data[0]["cliente_forma_pago"]).change();

        $("#txt_fecha_seguimiento").val(data[0]["cliente_fecha_seguimiento"]);
        $("#cbm_estado_bayer").val(data[0]["cliente_estado_bayer"]).change();

        $("#txt_idDependiente").val(data[0]["bayer_dependiente_id"]);
        $("#listaColaboradores").val(data[0]["cliente_familiares"]);
        $("#listaVehiculos").val(data[0]["cliente_vehiculos"]);

        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
        $(".valores_emision").number(true, 2);

        agregar_auto_Colaboradores();
        agregar_auto_observaciones();
        // block_info_cliente();
      } else {
        return (window.location = "prospecto-asignado-empresarial");
      }
    },
  });
}

function block_info_cliente() {
  // Deshabilitar temporalmente mientras se verifica
  setFieldsDisabled(true);

  var documento = $("#txt_documento").val();

  if (!documento) {
    setFieldsDisabled(false);
    return;
  }

  contador_cliente_contrato(documento, function (contador) {
    var existeCliente = contador > 0;

    setFieldsDisabled(existeCliente);
  });
}

function contador_cliente_contrato(cedula, callback) {
  if (!cedula) {
    callback(0);
    return;
  }

  var datos = new FormData();
  datos.append("cedula", cedula);

  $.ajax({
    url: "controller/bayer_persona/controlador_contador_cliente_existente.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // Asegurarse de que la respuesta sea un número
      var contador = parseInt(respuesta) || 0;
      callback(contador);
    },
    error: function (xhr, status, error) {
      console.error("Error al verificar cliente:", error);
      callback(0); // En caso de error, asumir que no existe
    },
  });
}

// Función auxiliar para manejar el estado de los campos
function setFieldsDisabled(disabled) {
  $("#txt_nombre").prop("disabled", disabled);
  $("#genero").prop("disabled", disabled);
  // $("#estado_civil").prop("disabled", disabled);
  $("#txt_fecha_nacimiento").prop("disabled", disabled);
  $("#txt_edad_nacimiento").prop("disabled", disabled);
  $("#txt_telefono").prop("disabled", disabled);
  $("#txt_email").prop("disabled", disabled);
  $("#cbm_provincia").prop("disabled", disabled);
  $("#txt_ciudad").prop("disabled", disabled);
  $("#txt_direccion").prop("disabled", disabled);
  $("#txt_ocupacion").prop("disabled", disabled);
  $("#cbm_ingreso_mensual").prop("disabled", disabled);
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
        valor = 0;
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
          '" style="text-transform: uppercase" value="Titular" disabled></input>' +
          "</div>" +
          "</div>" +
          "<!-- Nombre -->" +
          '<div class="col-6 col-md-3 order-md-2 my-1 ' +
          estado +
          ' etiquetaNombreColaborador" id = "etiquetaNombreColaborador' +
          numProspecto +
          '">' +
          "<label>Nombre</label>" +
          "</div>" +
          '<div class="col-6 col-md-3 order-md-8 my-1">' +
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
          '<option value="">' + t('messages.select_option_uppercase', 'SELECT...') + '</option>' +
          '<option value="masculino">Masculino</option>' +
          '<option value="femenino">Femenino</option>' +
          "</select>" +
          "</div>" +
          "<!-- Fecha de Nacimiento -->" +
          '<div class="col-6 col-md-3 order-md-4 my-1 ' +
          estado +
          ' etiquetaFechaColaborador" id = "etiquetaFechaColaborador' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label>Fecha Nacimiento</label>" +
          "</div>" +
          '<div class="col-6 col-md-3 order-md-10 my-1" style="padding-left:0px">' +
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
          '<input type="hidden" class="valor_deducible_colaborador" id="valor_deducible_colaborador' +
          numProspecto +
          '" name="valor_deducible_colaborador' +
          numProspecto +
          '" value="' +
          valor +
          '">' +
          '<button type="button" class="form-control btn btn-danger quitarColaborador" idColaborador="' +
          numProspecto +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoColaborador" + numProspecto)
        .val(data[i]["tipo"])
        .change();
      $("#generoColaborador" + numProspecto)
        .val(data[i]["genero"])
        .change();
      $("#listaFamiliares" + numProspecto).val(listar_dependientes);
    }
  }
}

function agregar_auto_observaciones() {
  var idProspecto = $("#txt_idProspecto").val();

  var datos = new FormData();

  datos.append("idProspecto", idProspecto);

  $.ajax({
    url: "controller/prospectos/controlador_observacion_prospecto_listar.php",
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

/*********************************
   MODIFICAR DATOS PROSPECTO
   *********************************/
function Modificar_Prospecto() {
  listarColaboradores();
  var idProspecto = $("#txt_idProspecto").val();
  var origen = $("#cbm_origen").val();
  var categoria = $("#cbm_categoria").val();
  var nuevo_categoria = $("#txt_nuevo_categoria").val().toUpperCase();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre_prospecto = $("#txt_nombre").val().toUpperCase();
  var telefono = $("#txt_telefono").val();
  var email = $("#txt_email").val();
  var provincia = $("#cbm_provincia").val();
  var ciudad = $("#txt_ciudad").val().toUpperCase();
  var direccion = $("#txt_direccion").val().toUpperCase();
  var ocupacion = $("#txt_ocupacion").val().toUpperCase();
  var valor_ingreso = $("#cbm_ingreso_mensual").val();
  var valor_asegurado = $("#txt_valor_asegurado").val();
  var prima_neta = $("#txt_prima_neta").val();
  var prima_comisionable = $("#txt_prima_comisionable").val();
  var prima_total = $("#txt_prima_total").val();
  var tipo_pago = $("#cbm_tipo_pago").val();
  var forma_pago = $("#cbm_forma_pago").val();
  var estado_bayer = $("#cbm_estado_bayer").val();
  var idDependiente = $("#txt_idDependiente").val();
  var listaColaboradores = $("#listaColaboradores").val();
  var listaVehiculos = $("#listaVehiculos").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val();
  var idEmpleado = $("#txt_idEmpleado").val();

  var cont_bayerpersonas = 0;
  var cont = 0;
  var cont1 = 0;

  if (idCliente.length == 0) {
    idCliente = 0;
  }

  if (origen.length == 0 || origen == null) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_origin', 'Fill in the origin field'),
      "warning"
    );
  }

  if (categoria.length == 0 || categoria == null) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_branch', 'Fill in the Branch field'),
      "warning"
    );
  }

  if (categoria == 0 && nuevo_categoria.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_new_branch', 'Fill in the new Branch field'),
      "warning"
    );
  }

  if (nombre_prospecto.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_prospect_name', 'Fill in the prospect name field'),
      "warning"
    );
  }

  if (provincia.length < 1) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_province', 'Fill in the province field'),
      "warning"
    );
  }

  if (cedula.length < 10 && estado_bayer == "CONTRATADO") {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.enter_valid_id', 'Enter valid ID Card and/or RUC number'),
      "warning"
    );
  }

  if (telefono.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_phone', 'Fill in the prospect phone field'),
      "warning"
    );
  }

  if (estado_bayer.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_prospect_status', 'Fill in the prospect status'),
      "warning"
    );
  }

  if (estado_bayer == "CONTRATADO") {
    if (
      origen.length == 0 ||
      categoria.length == 0 ||
      proveedor.length == 0 ||
      idProducto.length == 0 ||
      cedula.length == 0 ||
      nombre_prospecto.length == 0 ||
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
      cont_bayerpersonas++;
    }

    if (listaColaboradores.length > 0) {
      var data = JSON.parse(listaColaboradores);
      if (data.length > 0) {
        for (var i = 0; i < data.length; i++) {
          var tipo_dependiente = data[i]["tipo"];
          var genero_dependiente = data[i]["genero"];
          var edad_dependiente = data[i]["edad"];
          if (
            tipo_dependiente.length == 0 ||
            genero_dependiente.length == 0 ||
            edad_dependiente == null
          ) {
            cont++;
          }
        }
      }
    }

    if (listaVehiculos.length > 0) {
      var data1 = JSON.parse(listaVehiculos);
      if (data1.length > 0) {
        for (var i = 0; i < data1.length; i++) {
          var tipo_vehiculo = data1[i]["tipo"];
          var marca = data1[i]["marca"];
          var modelo = data1[i]["modelo"];
          var ano = data1[i]["ano"];
          var edad_vehiculo = data1[i]["edad"];
          var monto = data1[i]["monto"];
          if (
            tipo_vehiculo.length == 0 ||
            marca.length == 0 ||
            modelo.length == 0 ||
            ano.length == 0 ||
            edad_vehiculo == null ||
            monto.length == 0
          ) {
            cont1++;
          }
        }
      }
    }
  }

  if (cont_bayerpersonas > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios",
      "warning"
    );
  }

  if (cont > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de familiares",
      "warning"
    );
  }

  if (cont1 > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de vehiculos",
      "warning"
    );
  }

  crear_overlay_prospecto();

  var datos = new FormData();

  datos.append("idProspecto", idProspecto);
  datos.append("origen", origen);
  datos.append("categoria", categoria);
  datos.append("nuevo_categoria", nuevo_categoria);
  datos.append("proveedor", proveedor);
  datos.append("idProducto", idProducto);
  datos.append("idCliente", idCliente);
  datos.append("cedula", cedula);
  datos.append("nombre_prospecto", nombre_prospecto);
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
  datos.append("idDependiente", idDependiente);
  datos.append("listaColaboradores", listaColaboradores);
  datos.append("listaVehiculos", listaVehiculos);
  datos.append("listaObservaciones", listaObservaciones);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/prospectos-empresariales/controlador_prospecto_modificar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      console.log(respuesta);

      var data = JSON.parse(respuesta);
      // console.log(data);

      if (data[0]["valor"] == 1) {
        Swal.fire(
          t('messages.confirmation', 'Confirmation Message'),
          t('messages.prospect_updated', 'Data correctly, Prospect Updated'),
          "success"
        ).then((value) => {
          window.location = "prospecto-asignado-empresarial";
        });
      } else {
        Swal.fire(
          "Mensaje De Error",
          "Lo sentimos, no se pudo completar el registro",
          "error"
        );
      }
      eliminar_overlay_prospecto();
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

  buscar_cliente_id(idCliente);
});

function buscar_cliente_id(idCliente) {
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
        $("#txt_ocupacion").val("");
        $("#cbm_ingreso_mensual").val("").change();
      }
      block_info_cliente();

      $("#modalListarClientes").modal("hide");
    },
  });
}

$("#txt_documento").change(function () {
  var idProspecto = $("#txt_idProspecto").val();

  var cedula = $("#txt_documento").val();

  if (cedula.length > 0) {
    if (idProspecto == 0) {
      buscar_cliente_cedula(cedula);
    }
  }

  block_info_cliente();
});

function buscar_cliente_cedula(cedula) {
  var datos = new FormData();

  datos.append("cedula", cedula);

  $.ajax({
    url: "controller/clientes/controlador_traer_datos_cliente_cedula.php",
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
        $("#txt_idCliente").val("0");
        $("#txt_nombre").val("");
        $("#genero").val("").change();
        $("#txt_fecha_nacimiento").val("");
        $("#txt_email").val("");
        $("#txt_telefono").val("");
        $("#cbm_provincia").val("0").change();
        $("#txt_ciudad").val("");
        $("#txt_direccion").val("");
        $("#txt_ocupacion").val("");
        $("#cbm_ingreso_mensual").val("").change();
      }
    },
  });
}

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

var listarCheckAsignar = [];
var listarCheckAsignarTodos = 0;

$("#tabla_prospecto_empresarial").on(
  "click",
  ".chkSeleccionarAsignar",
  function () {
    var idProspecto = $(this).attr("idProspecto");
    // console.log(idProspecto);

    if ($(this).is(":checked")) {
      listarCheckAsignar.push(idProspecto);
    } else {
      listarCheckAsignar = listarCheckAsignar.filter(
        (lista) => lista != idProspecto
      );
    }

    console.log(listarCheckAsignar);
  }
);

$("#tabla_prospecto_empresarial").on(
  "click",
  ".chkSeleccionarTodoAsignar",
  function () {
    var checkTodo = $(".chkSeleccionarTodoAsignar");
    var estado = "false";
    if ($(checkTodo).is(":checked")) {
      estado = "true";
      listarCheckAsignarTodos = 1;
    } else {
      estado = "false";
      listarCheckAsignarTodos = 0;
    }

    seleccionarActivarODesactivarAsignar(estado);
  }
);

function seleccionarActivarODesactivarAsignar(estado) {
  var checkIndividual = $(".chkSeleccionarAsignar");

  for (var i = 0; i < checkIndividual.length; i++) {
    if (estado == "true") {
      $(checkIndividual[i]).prop("checked", true);
    } else {
      $(checkIndividual[i]).prop("checked", false);
    }
  }
}
