// function lista1() {
//   $.ajax({
//     url: "controller/empleados/controlador_empleados_listar_seleccionar.php",
//     method: "POST",
//     cache: false,
//     contentType: false,
//     processData: false,
//     async: false,
//     success: function (respuesta) {
//       console.log(respuesta);
//     },
//   });
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
  $("#tabla_prospecto").removeClass("nowrap");
  $("#tabla_prospecto").addClass("dt-responsive");
} else {
  $("#tabla_prospecto").removeClass("dt-responsive");
  $("#tabla_prospecto").addClass("nowrap");
}

var table_prospecto;
function listar_prospecto() {
  table_prospecto = $("#tabla_prospecto").DataTable({
    scrollX: true,
    ordering: false,
    destroy: true,
    processing: true,
    //     // "dom": "Plfrtip",
    dom: "PBfrtip", // 'P' para SearchPanes
    select: true, // Activa Select
    ajax: "controller/prospectos/controlador_prospecto_listar.php",
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
        targets: [3, 4, 11, 13, 15, 16, 17],
        searchPanes: { show: true },
      },
      {
        targets: [1, 2, 5, 6, 7, 8, 9, 10, 11, 12, 14, 17, 18],
        searchPanes: { show: false },
      },
    ],
    buttons: ["copyHtml5", "excelHtml5", "csvHtml5", "pdfHtml5"],
    fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      for (var i = 0; i <= 18; i++) {
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
// $("#tabla_prospecto").on("click", ".btnListaVendedor", function () {
//   $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
//   $("#modal_asignar_vendedor").modal("show");
// });

$("#btnListaVendedor").on("click", function () {
  $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
  $("#modal_asignar_vendedor").modal("show");
});

$("#tabla_lista_vendedores").on("click", ".btnAsignarVendedor", function () {
  var idEmpleado = $(this).attr("idEmpleado");

  if (listarCheckAsignar.length > 0) {
    for (let i = 0; i < listarCheckAsignar.length; i++) {
      let idProspecto = listarCheckAsignar[i];
      modificarVendedor(idProspecto, idEmpleado);
    }
    listarCheckAsignar = [];

    Swal.fire(
      t('messages.confirmation', 'Confirmation Message'),
      t('messages.seller_assigned', 'The seller has been assigned'),
      "success"
    ).then((value) => {
      table_prospecto.ajax.reload();
      $("#modal_asignar_vendedor").modal("hide");
    });
  } else {
    Swal.fire({
      icon: "error",
      title: t('messages.error_updating', 'Error updating'),
      text: t('messages.no_prospects_selected', 'No prospects selected to assign seller!'),
      confirmButtonText: t('messages.close', 'Close'),
    });
  }
});

function modificarVendedor(idProspecto, idEmpleado) {
  var datos = new FormData();
  datos.append("idProspecto", idProspecto);
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/prospectos/controlador_modificar_vendedor_asignado_a_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {},
  });
}
/*********************************
ABRI MODAL MODIFICAR ESTADO BAYER
*********************************/
$("#tabla_prospecto").on("click", ".btnEstadoBayer", function () {
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
    url: "controller/prospectos/controlador_modificar_estado_bayer_prospecto.php",
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
            "index.php?ruta=editar-prospecto&idProspecto=" + idProspecto;
        } else {
          $("#modal_estado_bayer").modal("hide");
          table_prospecto.ajax.reload();
        }
      }
    },
  });
}

/*********************************
 ABRIR MODAL CHAT
 *********************************/
var numObservacion = 0;
$("#tabla_prospecto").on("click", ".btnChatWeb", function () {
  $("#modalChatWeb").modal({ backdrop: "static", keyboard: false });
  $("#modalChatWeb").modal("show");

  numObservacion = 0;

  $("#todoChats").empty();

  var idProspecto = $(this).attr("idProspecto");

  var datos = new FormData();

  datos.append("idProspecto", idProspecto);

  $.ajax({
    url: "controller/prospectos/controlador_prospecto_chat.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#listaChats").val(data[0]["cliente_chat"]);

        var data1 = JSON.parse($("#listaChats").val());

        for (let i = 0; i < data1.length; i++) {
          numObservacion++;

          $("#todoChats").append(
            '<div class="col-12 my-1">' +
              '<div class="row col-12">' +
              "<!-- Pregunta -->" +
              '<div class="col-12 my-1" style="padding-right:0px">' +
              '<div class="input-group">' +
              '<label class="pregunta" id="pregunta' +
              numObservacion +
              '" name="pregunta' +
              numObservacion +
              '">Pregunta: ' +
              data1[i]["pregunta"] +
              "</label>" +
              "</div>" +
              "</div>" +
              "<!-- Respuesta -->" +
              '<div class="col-12 my-1">' +
              '<label class="respuesta" id="respuesta' +
              numObservacion +
              '" name="respuesta' +
              numObservacion +
              '">Respuesta: ' +
              data1[i]["respuesta"] +
              "</label>" +
              "</div>" +
              "</div>" +
              "</div>"
          );
        }
      } else {
        $("#todoChats").append(
          '<div class="col-12 my-1">' + "<p>SIN REGISTROS</p>" + '</div">'
        );
      }
    },
  });
});

/*********************************
EDITAR BAYER PERSONA
*********************************/
$("#tabla_prospecto").on("click", ".btnBayerPersona", function () {
  var idProspecto = $(this).attr("idProspecto");
  window.location =
    "index.php?ruta=editar-prospecto&idProspecto=" + idProspecto;
});

/*********************************
BLOQUE PARA CREAR NUEVO PROSPECTO
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
        cadena += "<option value='0'>Seleccione..</option>";
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

$(".nuevoDependiente").on("change", "select.tipoFamiliar", function () {
  listarFamiliares();
});

$(".nuevoDependiente").on("change", "input.nombreFamiliar", function () {
  listarFamiliares();
});

$(".nuevoDependiente").on("keyup", "input.nombreFamiliar", function () {
  listarFamiliares();
});

$(".nuevoDependiente").on("change", "select.generoFamiliar", function () {
  listarFamiliares();
});

$(".nuevoDependiente").on(
  "change",
  "input.fecha_nacimiento_Familiar",
  function () {
    listarFamiliares();
  }
);

/*=============================================
  AGREGANDO FAMILIAR
  =============================================*/

var numProspecto = 0;

$(".btnAgregarDependiente").click(function () {
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

  $(".nuevoDependiente").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridMiembroFamiliares">' +
      "<!-- Parentesco -->" +
      '<div class="col-6 col-md-2 order-md-1 my-1 ' +
      estado +
      ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
      numProspecto +
      '" style="padding-right:0px">' +
      "<label>Parentesco</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-6 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<select class="form-control tipoFamiliar" id="tipoFamiliar' +
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
      '<div class="col-6 col-md-4 order-md-7 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetras nombreFamiliar" id="nombreFamiliar' +
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
      '<div class="col-6 col-md-2 order-md-8 my-1">' +
      '<select class="form-control generoFamiliar" id="generoFamiliar' +
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
      '<div class="col-6 col-md-2 order-md-9 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="date" class="form-control fecha_nacimiento_Familiar" id="fecha_nacimiento_Familiar' +
      numProspecto +
      '" name="fecha_nacimiento_Familiar' +
      numProspecto +
      '" required>' +
      "</div>" +
      "</div>" +
      "<!-- Acciones -->" +
      '<div class="col-6 col-md-2 order-md-5 my-1 ' +
      estado1 +
      ' etiquetaAcciones" id = "etiquetaAcciones' +
      numProspecto +
      '" style="padding-left:0px">' +
      "<label></label>" +
      "</div>" +
      '<div class="col-12 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
      '<input type="hidden" class="valor_deducible_prospecto" id="valor_deducible_prospecto' +
      numProspecto +
      '" name="valor_deducible_prospecto' +
      numProspecto +
      '" value="0">' +
      '<button type="button" class="form-control btn btn-danger quitarDependiente" idFamiliar="' +
      numProspecto +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );
});

/*=============================================
  RECARGAR ETIQUETAS LISTAR FAMILIAR
  =============================================*/

function recargarEtiquetaslistarFamiliares() {
  var tipo = $(".etiquetaTipoFamiliar");

  var nombre = $(".etiquetaNombreFamiliar");

  var genero = $(".etiquetaGeneroFamiliar");

  var fecha_nacimiento = $(".etiquetaFechaNacimiento");

  var acciones = $(".etiquetaAcciones");

  for (var i = 0; i < tipo.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let nombre1 = $(nombre[i]).attr("id");
    let genero1 = $(genero[i]).attr("id");
    let fecha_nacimiento1 = $(fecha_nacimiento[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + nombre1).removeClass("d-md-none");
      $("#" + genero1).removeClass("d-md-none");
      $("#" + fecha_nacimiento1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + nombre1).addClass("d-md-none");
      $("#" + genero1).addClass("d-md-none");
      $("#" + fecha_nacimiento1).addClass("d-md-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
  LISTAR FAMILIAR
  =============================================*/

function listarFamiliares() {
  var listaFamiliares = [];

  var tipo = $(".tipoFamiliar");

  var nombre = $(".nombreFamiliar");

  var genero = $(".generoFamiliar");

  var fecha_nacimiento = $(".fecha_nacimiento_Familiar");

  var valor_deducible = $(".valor_deducible_prospecto");

  for (var i = 0; i < tipo.length; i++) {
    listaFamiliares.push({
      tipo: $(tipo[i]).val(),
      nombre: $(nombre[i]).val().trim().toUpperCase(),
      genero: $(genero[i]).val(),
      fecha_nacimiento: $(fecha_nacimiento[i]).val(),
      edad: getEdad($(fecha_nacimiento[i]).val()),
      valor_deducible: $(valor_deducible[i]).val(),
    });
  }

  $("#listaFamiliares").val(JSON.stringify(listaFamiliares));
}

/*=============================================
  QUITAR FAMILIAR
  =============================================*/

var idQuitarFamiliar = [];

localStorage.removeItem("quitarDependiente");

$(".nuevoDependiente").on("click", "button.quitarDependiente", function () {
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

/*=============================================
  AGREGANDO VEHICULO
  =============================================*/

var numVehiculo = 0;

$(".btnAgregarVehiculo").click(function () {
  numVehiculo++;

  var estado = "";
  var estado1 = "";

  if (numVehiculo > 1) {
    estado = "d-md-none";
    estado1 = "d-none";
  } else {
    estado = "";
    estado1 = "";
  }

  $(".nuevoVehiculo").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridMiembroFamiliares">' +
      "<!-- Tipo Vehiculo -->" +
      '<div class="col-6 col-md-2 order-md-1 my-1 ' +
      estado +
      ' etiquetaTipoVehiculo" id = "etiquetaTipoVehiculo' +
      numVehiculo +
      '" style="padding-right:0px">' +
      "<label>Tipo Vehiculo</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-9 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<select class="form-control tipoVehiculo" id="tipoVehiculo' +
      numVehiculo +
      '" name="tipoVehiculo' +
      numVehiculo +
      '" required>' +
      '<option value="" disabled selected>Seleccione..</option>' +
      '<option value="LIVIANO">LIVIANO</option>' +
      '<option value="CAMIONETA">CAMIONETA</option>' +
      '<option value="LIVIANO APLICACION">LIVIANO APLICACION</option>' +
      '<option value="MOTOS">MOTOS</option>' +
      '<option value="PESADO">PESADO</option>' +
      '<option value="FURGONETA ESCOLAR">FURGONETA ESCOLAR Y TURISMO</option>' +
      "</select>" +
      "</div>" +
      "</div>" +
      "<!-- Marca -->" +
      '<div class="col-6 col-md-2 order-md-2 my-1 ' +
      estado +
      ' etiquetaMarcaVehiculo" id = "etiquetaMarcaVehiculo' +
      numVehiculo +
      '">' +
      "<label>Marca</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-10 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetrasDecimal marcaVehiculo" id="marcaVehiculo' +
      numVehiculo +
      '" name="marcaVehiculo' +
      numVehiculo +
      '" placeholder="MARCA VEHICULO" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Modelo -->" +
      '<div class="col-6 col-md-2 order-md-3 my-1 ' +
      estado +
      ' etiquetaModeloVehiculo" id = "etiquetaModeloVehiculo' +
      numVehiculo +
      '">' +
      "<label>Modelo</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-11 my-1">' +
      '<input type="text" class="form-control validarNumerosLetrasDecimal modeloVehiculo" id="modeloVehiculo' +
      numVehiculo +
      '" name="modeloVehiculo' +
      numVehiculo +
      '" placeholder="MODELO VEHICULO" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "<!-- Color -->" +
      '<div class="col-6 col-md-2 order-md-4 my-1 ' +
      estado +
      ' etiquetaColorVehiculo" id = "etiquetaColorVehiculo' +
      numVehiculo +
      '" style="padding-left:0px">' +
      "<label>Color</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-12 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control colorVehiculo" id="colorVehiculo' +
      numVehiculo +
      '" name="colorVehiculo' +
      numVehiculo +
      '" placeholder="COLOR VEHICULO" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Año -->" +
      '<div class="col-6 col-md-1 order-md-5 my-1 ' +
      estado +
      ' etiquetaAnoVehiculo" id = "etiquetaAnoVehiculo' +
      numVehiculo +
      '" style="padding-left:0px">' +
      "<label>Año</label>" +
      "</div>" +
      '<div class="col-6 col-md-1 order-md-13 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumeros anoVehiculo" id="anoVehiculo' +
      numVehiculo +
      '" name="anoVehiculo' +
      numVehiculo +
      '" placeholder="AÑO VEHICULO" autocomplete="off" style="text-transform: uppercase" maxlength="4"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Placa -->" +
      '<div class="col-6 col-md-1 order-md-6 my-1 ' +
      estado +
      ' etiquetaPlacaVehiculo" id = "etiquetaPlacaVehiculo' +
      numVehiculo +
      '" style="padding-left:0px">' +
      "<label>Placa</label>" +
      "</div>" +
      '<div class="col-6 col-md-1 order-md-14 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control placaVehiculo" id="placaVehiculo' +
      numVehiculo +
      '" name="placaVehiculo' +
      numVehiculo +
      '" placeholder="PLACA VEHICULO" autocomplete="off" style="text-transform: uppercase" maxlength="10"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Monto -->" +
      '<div class="col-6 col-md-1 order-md-7 my-1 ' +
      estado +
      ' etiquetaMontoVehiculo" id = "etiquetaMontoVehiculo' +
      numVehiculo +
      '" style="padding-left:0px">' +
      "<label>Monto</label>" +
      "</div>" +
      '<div class="col-6 col-md-1 order-md-15 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="number" class="form-control validarNumerosDecimal montoVehiculo" id="montoVehiculo' +
      numVehiculo +
      '" name="montoVehiculo' +
      numVehiculo +
      '" placeholder="MONTO VEHICULO" min="0" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Acciones -->" +
      '<div class="col-6 col-md-1 order-md-8 my-1 ' +
      estado1 +
      ' etiquetaAcciones" id = "etiquetaAcciones' +
      numVehiculo +
      '" style="padding-left:0px">' +
      "<label></label>" +
      "</div>" +
      '<div class="col-12 col-md-1 order-md-16 my-1" style="padding-left:0px">' +
      '<input type="hidden" class="valor_deducible_vehiculo readOnly" id="valor_deducible_vehiculo' +
      numVehiculo +
      '" name="valor_deducible_vehiculo' +
      numVehiculo +
      '" value="0">' +
      '<button type="button" class="form-control btn btn-danger quitarVehiculo idVehiculo="' +
      numVehiculo +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );
});

/*=============================================
  RECARGAR ETIQUETAS LISTAR VEHICULO
  =============================================*/

function recargarEtiquetaslistarVehiculos() {
  var tipo = $(".etiquetaTipoVehiculo");

  var marca = $(".etiquetaMarcaVehiculo");

  var modelo = $(".etiquetaModeloVehiculo");

  var ano = $(".etiquetaAnoVehiculo");

  var placa = $(".etiquetaPlacaVehiculo");

  var color = $(".etiquetaColorVehiculo");

  var monto = $(".etiquetaMontoVehiculo");

  var acciones = $(".etiquetaAcciones");

  for (var i = 0; i < tipo.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let marca1 = $(marca[i]).attr("id");
    let modelo1 = $(modelo[i]).attr("id");
    let ano1 = $(ano[i]).attr("id");
    let monto1 = $(monto[i]).attr("id");
    let placa1 = $(placa[i]).attr("id");
    let color1 = $(color[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + marca1).removeClass("d-md-none");
      $("#" + modelo1).removeClass("d-md-none");
      $("#" + ano1).removeClass("d-md-none");
      $("#" + monto1).removeClass("d-md-none");
      $("#" + placa1).removeClass("d-md-none");
      $("#" + color1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + marca1).removeClass("d-md-none");
      $("#" + modelo1).removeClass("d-md-none");
      $("#" + ano1).removeClass("d-md-none");
      $("#" + monto1).removeClass("d-md-none");
      $("#" + placa1).removeClass("d-md-none");
      $("#" + color1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + marca1).addClass("d-md-none");
      $("#" + modelo1).addClass("d-md-none");
      $("#" + ano1).addClass("d-md-none");
      $("#" + monto1).addClass("d-md-none");
      $("#" + placa1).addClass("d-md-none");
      $("#" + color1).addClass("d-md-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
  LISTAR VEHICULO
  =============================================*/

function listarVehiculos() {
  var listaVehiculos = [];

  var tipo = $(".tipoVehiculo");

  var marca = $(".marcaVehiculo");

  var modelo = $(".modeloVehiculo");

  var ano = $(".anoVehiculo");

  var placa = $(".placaVehiculo");

  var color = $(".colorVehiculo");

  var monto = $(".montoVehiculo");

  var valor_deducible = $(".valor_deducible_vehiculoVehiculo");

  for (var i = 0; i < tipo.length; i++) {
    listaVehiculos.push({
      tipo: $(tipo[i]).val().trim(),
      marca: $(marca[i]).val().trim().toUpperCase(),
      modelo: $(modelo[i]).val().trim().toUpperCase(),
      ano: $(ano[i]).val(),
      placa: $(placa[i]).val().trim().toUpperCase(),
      color: $(color[i]).val().trim().toUpperCase(),
      edad: getEdadAno($(ano[i]).val()),
      monto: $(monto[i]).val(),
      valor_deducible: $(valor_deducible[i]).val(),
    });
  }

  $("#listaVehiculos").val(JSON.stringify(listaVehiculos));
}

/*=============================================
  QUITAR VEHICULO
  =============================================*/

var idQuitarVehiculo = [];

localStorage.removeItem("quitarVehiculo");

$(".nuevoVehiculo").on("click", "button.quitarVehiculo", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idVehiculo = $(this).attr("idVehiculo");

  /*=============================================
    ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
    =============================================*/

  if (localStorage.getItem("quitarVehiculo") == null) {
    idQuitarVehiculo = [];
  } else {
    idQuitarVehiculo.concat(localStorage.getItem("quitarVehiculo"));
  }

  idQuitarVehiculo.push({
    idVehiculo: idVehiculo,
  });

  localStorage.setItem("quitarVehiculo", JSON.stringify(idQuitarVehiculo));

  numVehiculo--;

  if ($(".nuevoVehiculo").children().length == 0) {
    $("#listaVehiculos").val("");
  } else {
    // AGRUPAR FAMILIARES EN FORMATO JSON
    listarVehiculos();
    recargarEtiquetaslistarVehiculos();
  }
});

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
  LIMPIAR LOS REGISTROS
  *********************************/
function LimpiarRegistro() {
  $(".nuevoDependiente").empty();
  $(".nuevaObservacion").empty();
  $("#listaFamiliares").val("");
  $("#listaVehiculos").val("");
  $("#listaObservaciones").val("");
  $("#cbm_origen").val("").change();
  $("#cbm_proveedor").val("").change();
  $("#txt_planes").val("");
  $("#txt_documento").val("");
  $("#txt_nombre").val("");
  $(".genero").val("").change();
  $("#txt_fecha_nacimiento").val("");
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
  listarFamiliares();
  listarVehiculos();
  listarHogares();

  var origen = $("#cbm_origen").val();
  var categoria = $("#cbm_categoria").val();
  var nuevo_categoria = $("#txt_nuevo_categoria").val().trim().toUpperCase();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre_prospecto = $("#txt_nombre").val().trim().toUpperCase();
  var genero = $("#genero").val();
  var estado_civil = $("#estado_civil").val();
  var fecha_nacimiento = $("#txt_fecha_nacimiento").val();
  var edad_nacimiento = $("#txt_edad_nacimiento").val();
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
  var listaFamiliares = $("#listaFamiliares").val();
  var listaVehiculos = $("#listaVehiculos").val();
  var listaHogares = $("#listaHogares").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val().trim();

  var cont_bayerpersonas = 0;
  var cont = 0;
  var cont1 = 0;
  var cont2 = 0;

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

  if (genero.length == 0) {
    return Swal.fire(
      t('messages.warning', 'Warning Message'),
      t('messages.fill_field_prospect_gender', 'Fill in the prospect gender field'),
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
      cont_bayerpersonas++;
    }

    if (listaFamiliares.length > 0) {
      var data = JSON.parse(listaFamiliares);
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
          var color = data1[i]["color"];
          var placa = data1[i]["placa"];
          var ano = data1[i]["ano"];
          var edad_vehiculo = data1[i]["edad"];
          var monto = data1[i]["monto"];

          if (
            tipo_vehiculo.length == 0 ||
            marca.length == 0 ||
            modelo.length == 0 ||
            color.length == 0 ||
            placa.length == 0 ||
            ano.length == 0 ||
            edad_vehiculo == null ||
            monto.length == 0
          ) {
            cont1++;
          }
        }
      }
    }

    if (listaHogares.length > 0) {
      var data2 = JSON.parse(listaHogares);
      if (data2.length > 0) {
        for (var i = 0; i < data2.length; i++) {
          var tipo_hogar = data2[i]["tipo"];
          var direccion = data2[i]["direccion"];
          var ano_construccion = data2[i]["ano_construccion"];
          var valor_vivienda = data2[i]["valor_vivienda"];
          var valor_otras_cosas = data2[i]["valor_otras_cosas"];
          var monto = data2[i]["monto"];
          if (
            tipo_hogar.length == 0 ||
            direccion.length == 0 ||
            ano_construccion.length == 0 ||
            valor_vivienda.length == 0 ||
            valor_otras_cosas.length == 0 ||
            monto.length == 0
          ) {
            cont2++;
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

  if (cont2 > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de Hogares",
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
  datos.append("genero", genero);
  datos.append("estado_civil", estado_civil);
  datos.append("fecha_nacimiento", fecha_nacimiento);
  datos.append("edad_nacimiento", edad_nacimiento);
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
  datos.append("listaFamiliares", listaFamiliares);
  datos.append("listaVehiculos", listaVehiculos);
  datos.append("listaHogares", listaHogares);
  datos.append("listaObservaciones", listaObservaciones);
  datos.append("fecha_seguimiento", fecha_seguimiento);

  $.ajax({
    url: "controller/prospectos/controlador_prospecto_registro.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        Swal.fire(
          "Mensaje De Confirmacion",
          "Datos correctamente, Nuevo Prospecto Registrado",
          "success"
        ).then((value) => {
          window.location = "prospecto-asignado";
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
    url: "controller/prospectos/controlador_traer_datos_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      // console.log(respuesta);

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
        data[0]["cliente_estado_civil"]
          ? $("#estado_civil")
              .val(data[0]["cliente_estado_civil"].toUpperCase())
              .change()
          : $("#estado_civil").val("").change();
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_edad_nacimiento").val(data[0]["cliente_edad"]);
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
        $("#listaFamiliares").val(data[0]["cliente_familiares"]);
        $("#listaVehiculos").val(data[0]["cliente_vehiculos"]);
        $("#listaHogares").val(data[0]["cliente_hogares"]);

        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
        $(".valores_emision").number(true, 2);

        agregar_auto_familiares();
        agregar_auto_vehiculos();
        agregar_auto_hogares();
        agregar_auto_observaciones();
        actualizar_edad_fecha_nacimiento();
        block_info_cliente();
      } else {
        return (window.location = "prospecto-asignado");
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
    mensaje_cedula_duplicada(contador);
  });
}

function mensaje_cedula_duplicada(contador) {
  var existeCliente = contador > 0;

  Swal.fire(
    "Mensaje De Advertencia",
    "Cedula ya registrada en " +
      contador +
      " contrato(s). Los campos de informaci&oacute;n personal han sido deshabilitados para evitar modificaciones.",
    "warning"
  ).then((value) => {
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

$("#txt_fecha_nacimiento").on("change", function () {
  actualizar_edad_fecha_nacimiento();
});

function actualizar_edad_fecha_nacimiento() {
  var fechaNacimiento = $("#txt_fecha_nacimiento").val();
  var edad = getEdad(fechaNacimiento);
  $("#txt_edad_nacimiento").val(edad);
}

function agregar_auto_familiares() {
  var lista = $("#listaFamiliares").val();

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

      $(".nuevoDependiente").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridMiembroFamiliares">' +
          "<!-- Parentesco -->" +
          '<div class="col-6 col-md-2 order-md-1 my-1 ' +
          estado +
          ' etiquetaTipoFamiliar" id = "etiquetaTipoFamiliar' +
          numProspecto +
          '" style="padding-right:0px">' +
          "<label>Parentesco</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-6 my-1" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<select class="form-control tipoFamiliar" id="tipoFamiliar' +
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
          '<div class="col-6 col-md-4 order-md-7 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras nombreFamiliar" id="nombreFamiliar' +
          numProspecto +
          '" name="nombreFamiliar' +
          numProspecto +
          '" placeholder="INGRESE NOMBRE" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["nombre"] +
          '"></input>' +
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
          '<div class="col-6 col-md-2 order-md-8 my-1">' +
          '<select class="form-control generoFamiliar" id="generoFamiliar' +
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
          '<div class="col-6 col-md-2 order-md-9 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="date" class="form-control fecha_nacimiento_Familiar" id="fecha_nacimiento_Familiar' +
          numProspecto +
          '" name="fecha_nacimiento_Familiar' +
          numProspecto +
          '" value= "' +
          data[i]["fecha_nacimiento"] +
          '" required>' +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="col-6 col-md-2 order-md-5 my-1 ' +
          estado1 +
          ' etiquetaAcciones" id = "etiquetaAcciones' +
          numProspecto +
          '" style="padding-left:0px">' +
          "<label></label>" +
          "</div>" +
          '<div class="col-12 col-md-2 order-md-10 my-1" style="padding-left:0px">' +
          '<input type="hidden" class="valor_deducible_prospecto" id="valor_deducible_prospecto' +
          numProspecto +
          '" name="valor_deducible_prospecto' +
          numProspecto +
          '" value="' +
          valor +
          '">' +
          '<button type="button" class="form-control btn btn-danger quitarDependiente" idFamiliar="' +
          numProspecto +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoFamiliar" + numProspecto)
        .val(data[i]["tipo"])
        .change();
      $("#generoFamiliar" + numProspecto)
        .val(data[i]["genero"])
        .change();
    }
  }
}

function agregar_auto_vehiculos() {
  var lista = $("#listaVehiculos").val();

  if (lista.length > 0) {
    var data = JSON.parse(lista);

    for (let i = 0; i < data.length; i++) {
      numVehiculo++;

      var estado = "";
      var estado1 = "";
      var valor = 0;

      if (numVehiculo > 1) {
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

      $(".nuevoVehiculo").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridMiembroVehiculos">' +
          "<!-- Tipo Vehiculo -->" +
          '<div class="col-6 col-md-2 order-md-1 my-1 ' +
          estado +
          ' etiquetaTipoVehiculos" id = "etiquetaTipoVehiculos' +
          numVehiculo +
          '" style="padding-right:0px">' +
          "<label>Tipo Vehiculo</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-9 my-1" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<select class="form-control tipoVehiculo" id="tipoVehiculo' +
          numVehiculo +
          '" name="tipoVehiculo' +
          numVehiculo +
          '" required>' +
          '<option value="" disabled selected>Seleccione..</option>' +
          '<option value="LIVIANO">LIVIANO</option>' +
          '<option value="CAMIONETA">CAMIONETA</option>' +
          '<option value="LIVIANO APLICACION">LIVIANO APLICACION</option>' +
          '<option value="MOTOS">MOTOS</option>' +
          '<option value="PESADO">PESADO</option>' +
          '<option value="FURGONETA ESCOLAR">FURGONETA ESCOLAR Y TURISMO</option>' +
          "</select>" +
          "</div>" +
          "</div>" +
          "<!-- Marca -->" +
          '<div class="col-6 col-md-2 order-md-2 my-1 ' +
          estado +
          ' etiquetaMarcaVehiculo" id = "etiquetaMarcaVehiculo' +
          numVehiculo +
          '">' +
          "<label>Marca</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-10 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras marcaVehiculo" id="marcaVehiculo' +
          numVehiculo +
          '" name="marcaVehiculo' +
          numVehiculo +
          '" placeholder="MARCA VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["marca"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Modelo -->" +
          '<div class="col-6 col-md-2 order-md-3 my-1 ' +
          estado +
          ' etiquetaModeloVehiculo" id = "etiquetaModeloVehiculo' +
          numVehiculo +
          '">' +
          "<label>Modelo</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-11 my-1">' +
          '<input type="text" class="form-control validarNumerosLetras modeloVehiculo" id="modeloVehiculo' +
          numVehiculo +
          '" name="modeloVehiculo' +
          numVehiculo +
          '" placeholder="MODELO VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["modelo"] +
          '"></input>' +
          "</div>" +
          "<!-- Color -->" +
          '<div class="col-6 col-md-2 order-md-4 my-1 ' +
          estado +
          ' etiquetaColorVehiculo" id = "etiquetaColorVehiculo' +
          numVehiculo +
          '" style="padding-left:0px">' +
          "<label>Color</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-12 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control colorVehiculo" id="colorVehiculo' +
          numVehiculo +
          '" name="colorVehiculo' +
          numVehiculo +
          '" placeholder="COLOR VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["color"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Año -->" +
          '<div class="col-6 col-md-1 order-md-5 my-1 ' +
          estado +
          ' etiquetaAnoVehiculo" id = "etiquetaAnoVehiculo' +
          numVehiculo +
          '" style="padding-left:0px">' +
          "<label>Año</label>" +
          "</div>" +
          '<div class="col-6 col-md-1 order-md-13 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras anoVehiculo" id="anoVehiculo' +
          numVehiculo +
          '" name="anoVehiculo' +
          numVehiculo +
          '" placeholder="AÑO VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["ano"] +
          '" maxlength="4"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Placa -->" +
          '<div class="col-6 col-md-1 order-md-6 my-1 ' +
          estado +
          ' etiquetaPlacaVehiculo" id = "etiquetaPlacaVehiculo' +
          numVehiculo +
          '" style="padding-left:0px">' +
          "<label>Placa</label>" +
          "</div>" +
          '<div class="col-6 col-md-1 order-md-14 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras placaVehiculo" id="placaVehiculo' +
          numVehiculo +
          '" name="placaVehiculo' +
          numVehiculo +
          '" placeholder="PLACA VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["placa"] +
          '" maxlength="10"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Monto -->" +
          '<div class="col-6 col-md-1 order-md-7 my-1 ' +
          estado +
          ' etiquetaMontoVehiculo" id = "etiquetaMontoVehiculo' +
          numVehiculo +
          '" style="padding-left:0px">' +
          "<label>Monto</label>" +
          "</div>" +
          '<div class="col-6 col-md-1 order-md-15 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras montoVehiculo" id="montoVehiculo' +
          numVehiculo +
          '" name="montoVehiculo' +
          numVehiculo +
          '" placeholder="MONTO VEHICULO" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["monto"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="col-6 col-md-1 order-md-8 my-1 ' +
          estado1 +
          ' etiquetaAcciones" id = "etiquetaAcciones' +
          numVehiculo +
          '" style="padding-left:0px">' +
          "<label></label>" +
          "</div>" +
          '<div class="col-12 col-md-1 order-md-16 my-1" style="padding-left:0px">' +
          '<input type="hidden" class="valor_deducible_vehiculo" id="valor_deducible_vehiculo' +
          numVehiculo +
          '" name="valor_deducible_vehiculo' +
          numVehiculo +
          '" value="' +
          valor +
          '">' +
          '<button type="button" class="form-control btn btn-danger quitarVehiculo idVehiculo="' +
          numVehiculo +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoVehiculo" + numVehiculo)
        .val(data[i]["tipo"])
        .change();

      $("#estadoCivil" + numVehiculo)
        .val(
          data[i]["estado_civil"] ? data[i]["estado_civil"].toUpperCase() : ""
        )
        .change();
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
  listarFamiliares();
  listarVehiculos();
  listarHogares();

  var idProspecto = $("#txt_idProspecto").val();
  var origen = $("#cbm_origen").val();
  var categoria = $("#cbm_categoria").val();
  var nuevo_categoria = $("#txt_nuevo_categoria").val().trim().toUpperCase();
  var proveedor = $("#cbm_proveedor").val();
  var idProducto = $("#txt_planes").val();
  var idCliente = $("#txt_idCliente").val();
  var cedula = $("#txt_documento").val().trim();
  var nombre_prospecto = $("#txt_nombre").val().trim().toUpperCase();
  var genero = $("#genero").val();
  var estado_civil = $("#estado_civil").val();
  var fecha_nacimiento = $("#txt_fecha_nacimiento").val();
  var edad_nacimiento = $("#txt_edad_nacimiento").val();
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
  var idDependiente = $("#txt_idDependiente").val();
  var listaFamiliares = $("#listaFamiliares").val();
  var listaVehiculos = $("#listaVehiculos").val();
  var listaHogares = $("#listaHogares").val();
  var listaObservaciones = $("#listaObservaciones").val();
  var fecha_seguimiento = $("#txt_fecha_seguimiento").val().trim();
  var idEmpleado = $("#txt_idEmpleado").val();

  var cont_bayerpersonas = 0;
  var cont = 0;
  var cont1 = 0;
  var cont2 = 0;

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

  if (nombre_prospecto.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo  nombre prospecto",
      "warning"
    );
  }

  if (genero.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo genero prospecto",
      "warning"
    );
  }

  if (provincia.length < 1) {
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

  if (telefono.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el campo telefono prospecto",
      "warning"
    );
  }

  if (estado_bayer.length == 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene el estado del prospecto",
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
      cont_bayerpersonas++;
    }

    if (listaFamiliares.length > 0) {
      var data = JSON.parse(listaFamiliares);
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
    } else {
      var listaFamiliaresTemp = [];

      listaFamiliaresTemp.push({
        tipo: "Titular",
        nombre: nombre_prospecto,
        genero: genero,
        fecha_nacimiento: fecha_nacimiento,
        edad: getEdad(fecha_nacimiento),
        valor_deducible: 0,
      });
      listaFamiliares = listaFamiliaresTemp;
    }

    if (listaVehiculos.length > 0) {
      var data1 = JSON.parse(listaVehiculos);
      if (data1.length > 0) {
        for (var i = 0; i < data1.length; i++) {
          var tipo_vehiculo = data1[i]["tipo"];
          var marca = data1[i]["marca"];
          var modelo = data1[i]["modelo"];
          var color = data1[i]["color"];
          var placa = data1[i]["placa"];
          var ano = data1[i]["ano"];
          var edad_vehiculo = data1[i]["edad"];
          var monto = data1[i]["monto"];
          if (
            tipo_vehiculo.length == 0 ||
            marca.length == 0 ||
            modelo.length == 0 ||
            color.length == 0 ||
            placa.length == 0 ||
            ano.length == 0 ||
            edad_vehiculo == null ||
            monto.length == 0
          ) {
            cont1++;
          }
        }
      }
    }

    if (listaHogares.length > 0) {
      var data2 = JSON.parse(listaHogares);
      if (data2.length > 0) {
        for (var i = 0; i < data2.length; i++) {
          var tipo_hogar = data2[i]["tipo"];
          var direccion = data2[i]["direccion"];
          var ano_construccion = data2[i]["ano_construccion"];
          var valor_vivienda = data2[i]["valor_vivienda"];
          var valor_otras_cosas = data2[i]["valor_otras_cosas"];
          var monto = data2[i]["monto"];
          if (
            tipo_hogar.length == 0 ||
            direccion.length == 0 ||
            ano_construccion.length == 0 ||
            valor_vivienda.length == 0 ||
            valor_otras_cosas.length == 0 ||
            monto.length == 0
          ) {
            cont2++;
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

  if (cont2 > 0) {
    return Swal.fire(
      "Mensaje De Advertencia",
      "Llene los campos vacios de Hogares",
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
  datos.append("genero", genero);
  datos.append("estado_civil", estado_civil);
  datos.append("fecha_nacimiento", fecha_nacimiento);
  datos.append("edad_nacimiento", edad_nacimiento);
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
  datos.append("listaFamiliares", listaFamiliares);
  datos.append("listaVehiculos", listaVehiculos);
  datos.append("listaHogares", listaHogares);
  datos.append("listaObservaciones", listaObservaciones);
  datos.append("fecha_seguimiento", fecha_seguimiento);
  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "controller/prospectos/controlador_prospecto_modificar.php",
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
          "Datos correctamente, Actualizado Prospecto",
          "success"
        ).then((value) => {
          window.location = "prospecto-asignado";
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
      // console.log(respuesta);

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
              ? data[0]["cliente_estado_civil"]
              : ""
          )
          .change();
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_edad_nacimiento").val(data[0]["cliente_edad"]);
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
        $("#estado_civil").val("").change();
        $("#txt_fecha_nacimiento").val("");
        $("#txt_edad_nacimiento").val("");
        $("#txt_email").val("");
        $("#txt_telefono").val("");
        $("#cbm_provincia").val("0").change();
        $("#txt_ciudad").val("");
        $("#txt_direccion").val("");
        $("#txt_ocupacion").val("");
        $("#cbm_ingreso_mensual").val("").change();
      }

      actualizar_edad_fecha_nacimiento();

      block_info_cliente();

      $("#modalListarClientes").modal("hide");
    },
  });
}

$("#txt_documento").change(function () {
  var idProspecto = $("#txt_idProspecto").val();

  var cedula = $("#txt_documento").val();

  if (cedula.length > 0) {
    // if (idProspecto == 0) {
    buscar_cliente_cedula(cedula);
    // }
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
        $("#estado_civil")
          .val(
            data[0]["cliente_estado_civil"]
              ? data[0]["cliente_estado_civil"]
              : ""
          )
          .change();
        $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
        $("#txt_edad_nacimiento").val(data[0]["cliente_edad"]);
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
        $("#estado_civil").val("").change();
        $("#txt_fecha_nacimiento").val("");
        $("#txt_edad_nacimiento").val("");
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

$("#tabla_prospecto").on("click", ".chkSeleccionarAsignar", function () {
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
});

$("#tabla_prospecto").on("click", ".chkSeleccionarTodoAsignar", function () {
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
});

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

/*=============================================
  AGREGANDO HOGAR
  =============================================*/

var numHogar = 0;

$(".btnAgregarHogar").click(function () {
  numHogar++;

  var estado = "";
  var estado1 = "";

  if (numHogar > 1) {
    estado = "d-md-none";
    estado1 = "d-none";
  } else {
    estado = "";
    estado1 = "";
  }

  $(".nuevoHogar").append(
    '<div class="col-12 my-1">' +
      '<div class="row gridHogares">' +
      "<!-- Tipo Hogar -->" +
      '<div class="col-6 col-md-2 order-md-1 my-1 ' +
      estado +
      ' etiquetaTipoHogar" id = "etiquetaTipoHogar' +
      numHogar +
      '" style="padding-right:0px">' +
      "<label>Tipo Hogar</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-8 my-1" style="padding-right:0px">' +
      '<div class="input-group">' +
      '<select class="form-control tipoHogar" id="tipoHogar' +
      numHogar +
      '" name="tipoHogar' +
      numHogar +
      '" required>' +
      '<option value= "">Seleccione...</option>' +
      '<option value="PROPIO">PROPIO</option>' +
      '<option value="ARRENDADO">ARRENDADO</option>' +
      "</select>" +
      "</div>" +
      "</div>" +
      "<!-- Direccion -->" +
      '<div class="col-6 col-md-2 order-md-2 my-1 ' +
      estado +
      ' etiquetaDireccionHogar" id = "etiquetaDireccionHogar' +
      numHogar +
      '">' +
      "<label>Dirección</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-9 my-1">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumerosLetrasDecimal direccionHogar" id="direccionHogar' +
      numHogar +
      '" name="direccionHogar' +
      numHogar +
      '" placeholder="DIRECCION HOGAR" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Año COnstruccion -->" +
      '<div class="col-6 col-md-2 order-md-3 my-1 ' +
      estado +
      ' etiquetaAnoConstruccionHogar" id = "etiquetaAnoConstruccionHogar' +
      numHogar +
      '">' +
      "<label>Año Construcción</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-10 my-1">' +
      '<input type="text" class="form-control validarNumerosLetrasDecimal anoConstruccionHogar" id="anoConstruccionHogar' +
      numHogar +
      '" name="anoConstruccionHogar' +
      numHogar +
      '" placeholder="AÑO CONSTRUCCIÓN" autocomplete="off" style="text-transform: uppercase" maxlength="4"></input>' +
      "</div>" +
      "<!-- Valor Vivienda -->" +
      '<div class="col-6 col-md-1 order-md-4 my-1 ' +
      estado +
      ' etiquetaValorViviendaHogar" id = "etiquetaValorViviendaHogar' +
      numHogar +
      '" style="padding-left:0px">' +
      "<label>Valor Vivienda</label>" +
      "</div>" +
      '<div class="col-6 col-md-1 order-md-11 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control validarNumeros valorViviendaHogar" id="valorViviendaHogar' +
      numHogar +
      '" name="valorViviendaHogar' +
      numHogar +
      '" placeholder="VALOR VIVIENDA" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Valor Otras Cosas -->" +
      '<div class="col-6 col-md-2 order-md-5 my-1 ' +
      estado +
      ' etiquetaValorOtrasCosas" id = "etiquetaValorOtrasCosas' +
      numHogar +
      '" style="padding-left:0px">' +
      "<label>Valor Interior Contenido Vivienda</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-12 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="text" class="form-control valorOtrasCosasHogar" id="valorOtrasCosasHogar' +
      numHogar +
      '" name="valorOtrasCosasHogar' +
      numHogar +
      '" placeholder="VALOR OTRAS COSAS" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Monto -->" +
      '<div class="col-6 col-md-2 order-md-6 my-1 ' +
      estado +
      ' etiquetaMontoHogar" id = "etiquetaMontoHogar' +
      numHogar +
      '" style="padding-left:0px">' +
      "<label>Monto</label>" +
      "</div>" +
      '<div class="col-6 col-md-2 order-md-13 my-1" style="padding-left:0px">' +
      '<div class="input-group">' +
      '<input type="number" class="form-control validarNumerosDecimal montoHogar" id="montoHogar' +
      numHogar +
      '" name="montoHogar' +
      numHogar +
      '" placeholder="MONTO HOGAR" min="0" autocomplete="off" style="text-transform: uppercase"></input>' +
      "</div>" +
      "</div>" +
      "<!-- Acciones -->" +
      '<div class="col-6 col-md-1 order-md-7 my-1 ' +
      estado1 +
      ' etiquetaAcciones" id = "etiquetaAcciones' +
      numHogar +
      '" style="padding-left:0px">' +
      "<label></label>" +
      "</div>" +
      '<div class="col-12 col-md-1 order-md-14 my-1" style="padding-left:0px">' +
      '<input type="hidden" class="valor_deducible_hogar" id="valor_deducible_hogar' +
      numHogar +
      '" name="valor_deducible_hogar' +
      numHogar +
      '" value="0">' +
      '<button type="button" class="form-control btn btn-danger quitarHogar idHogar="' +
      numHogar +
      '"><i class="fa fa-times"></i></button>' +
      "</div>" +
      "</div>" +
      "</div>"
  );
});

/*=============================================
    RECARGAR ETIQUETAS LISTAR HOGAR
    =============================================*/

function recargarEtiquetaslistarHogares() {
  var tipo = $(".etiquetaTipoHogar");

  var direccion = $(".etiquetaDireccionHogar");

  var ano_construccion = $(".etiquetaAnoConstruccionHogar");

  var valor_vivienda = $(".etiquetaValorViviendaHogar");

  var valor_otras_cosas = $(".etiquetaValorOtrasCosas");

  var monto = $(".etiquetaMontoHogar");

  var acciones = $(".etiquetaAcciones");

  for (var i = 0; i < tipo.length; i++) {
    let tipo1 = $(tipo[i]).attr("id");
    let direccion1 = $(direccion[i]).attr("id");
    let ano_construccion1 = $(ano_construccion[i]).attr("id");
    let valor_vivienda1 = $(valor_vivienda[i]).attr("id");
    let valor_otras_cosas1 = $(valor_otras_cosas[i]).attr("id");
    let monto1 = $(monto[i]).attr("id");
    let acciones1 = $(acciones[i]).attr("id");

    if (i == 0) {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + direccion1).removeClass("d-md-none");
      $("#" + ano_construccion1).removeClass("d-md-none");
      $("#" + valor_vivienda1).removeClass("d-md-none");
      $("#" + valor_otras_cosas1).removeClass("d-md-none");
      $("#" + monto1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");
    } else {
      $("#" + tipo1).removeClass("d-md-none");
      $("#" + direccion1).removeClass("d-md-none");
      $("#" + ano_construccion1).removeClass("d-md-none");
      $("#" + valor_vivienda1).removeClass("d-md-none");
      $("#" + valor_otras_cosas1).removeClass("d-md-none");
      $("#" + monto1).removeClass("d-md-none");
      $("#" + acciones1).removeClass("d-none");

      $("#" + tipo1).addClass("d-md-none");
      $("#" + direccion1).addClass("d-md-none");
      $("#" + ano_construccion1).addClass("d-md-none");
      $("#" + valor_vivienda1).addClass("d-md-none");
      $("#" + valor_otras_cosas1).addClass("d-md-none");
      $("#" + monto1).addClass("d-md-none");
      $("#" + acciones1).addClass("d-none");
    }
  }
}

/*=============================================
    LISTAR HOGAR
    =============================================*/

function listarHogares() {
  var listaHogares = [];

  var tipo = $(".tipoHogar");

  var direccion = $(".direccionHogar");

  var ano_construccion = $(".anoConstruccionHogar");

  var valor_vivienda = $(".valorViviendaHogar");

  var valor_otras_cosas = $(".valorOtrasCosasHogar");

  var monto = $(".montoHogar");

  var valor_deducible = $(".valor_deducible_hogar");

  for (var i = 0; i < tipo.length; i++) {
    listaHogares.push({
      tipo: $(tipo[i]).val().trim(),
      direccion: $(direccion[i]).val().trim().toUpperCase(),
      ano_construccion: $(ano_construccion[i]).val(),
      valor_vivienda: $(valor_vivienda[i]).val(),
      valor_otras_cosas: $(valor_otras_cosas[i]).val(),
      monto: $(monto[i]).val(),
      valor_deducible: $(valor_deducible[i]).val(),
    });
  }

  $("#listaHogares").val(JSON.stringify(listaHogares));
}

/*=============================================
    QUITAR HOGAR
    =============================================*/

var idQuitarHogar = [];

localStorage.removeItem("quitarHogar");

$(".nuevoHogar").on("click", "button.quitarHogar", function () {
  // $(this).parent().parent().parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  // $(this).parent().parent().parent().css({"color": "red", "border": "2px solid red"});
  $(this).parent().parent().parent().remove();

  var idHogar = $(this).attr("idHogar");

  /*=============================================
      ALMACENAR EN EL LOCALSTORAGE EL ID DEL HOGAR A QUITAR
      =============================================*/

  if (localStorage.getItem("quitarHogar") == null) {
    idQuitarHogar = [];
  } else {
    idQuitarHogar.concat(localStorage.getItem("quitarHogar"));
  }

  idQuitarHogar.push({
    idHogar: idHogar,
  });

  localStorage.setItem("quitarHogar", JSON.stringify(idQuitarHogar));

  numHogar--;

  if ($(".nuevoHogar").children().length == 0) {
    $("#listaHogares").val("");
  } else {
    // AGRUPAR HOGARES EN FORMATO JSON
    listarHogares();
    recargarEtiquetaslistarHogares();
  }
});

function agregar_auto_hogares() {
  var lista = $("#listaHogares").val();

  if (lista.length > 0) {
    var data = JSON.parse(lista);

    for (let i = 0; i < data.length; i++) {
      numHogar++;

      var estado = "";
      var estado1 = "";
      var valor = 0;

      if (numHogar > 1) {
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

      $(".nuevoHogar").append(
        '<div class="col-12 my-1">' +
          '<div class="row gridMiembroHogares">' +
          "<!-- Tipo Hogar -->" +
          '<div class="col-6 col-md-2 order-md-1 my-1 ' +
          estado +
          ' etiquetaTipoHogares" id = "etiquetaTipoHogares' +
          numHogar +
          '" style="padding-right:0px">' +
          "<label>Tipo Hogar</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-8 my-1" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<select class="form-control tipoHogar" id="tipoHogar' +
          numHogar +
          '" name="tipoHogar' +
          numHogar +
          '" required>' +
          '<option value= "">Seleccione...</option>' +
          '<option value="PROPIO">PROPIO</option>' +
          '<option value="ARRENDADO">ARRENDADO</option>' +
          "</select>" +
          "</div>" +
          "</div>" +
          "<!-- Direccion -->" +
          '<div class="col-6 col-md-2 order-md-2 my-1 ' +
          estado +
          ' etiquetaDireccionHogar" id = "etiquetaDireccionHogar' +
          numHogar +
          '">' +
          "<label>Direccion</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-9 my-1">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras direccionHogar" id="direccionHogar' +
          numHogar +
          '" name="direccionHogar' +
          numHogar +
          '" placeholder="DIRECCIÓN HOGAR" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["direccion"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Año Construccion -->" +
          '<div class="col-6 col-md-2 order-md-3 my-1 ' +
          estado +
          ' etiquetaAnoConstruccion" id = "etiquetaAnoConstruccion' +
          numHogar +
          '">' +
          "<label>Año Construcción</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-10 my-1">' +
          '<input type="text" class="form-control validarNumerosLetras anoConstruccionHogar" id="anoConstruccionHogar' +
          numHogar +
          '" name="anoConstruccionHogar' +
          numHogar +
          '" placeholder="AÑO CONSTRUCCION" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["ano_construccion"] +
          '" maxlength="4"></input>' +
          "</div>" +
          "<!-- Valor Vivienda -->" +
          '<div class="col-6 col-md-1 order-md-4 my-1 ' +
          estado +
          ' etiquetaValorVivienda" id = "etiquetaValorVivienda' +
          numHogar +
          '" style="padding-left:0px">' +
          "<label>Valor Vivienda</label>" +
          "</div>" +
          '<div class="col-6 col-md-1 order-md-11 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras valorViviendaHogar" id="valorViviendaHogar' +
          numHogar +
          '" name="valorViviendaHogar' +
          numHogar +
          '" placeholder="VALOR HOGAR" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["valor_vivienda"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Valor Otras Cosas -->" +
          '<div class="col-6 col-md-2 order-md-5 my-1 ' +
          estado +
          ' etiquetaValorOtrasCosasHogar" id = "etiquetaValorOtrasCosasHogar' +
          numHogar +
          '" style="padding-left:0px">' +
          "<label>Valor Interior Contenido Vivienda</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-12 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras valorOtrasCosasHogar" id="valorOtrasCosasHogar' +
          numHogar +
          '" name="valorOtrasCosasHogar' +
          numHogar +
          '" placeholder="VALOR OTRAS COSAS HOGAR" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["valor_otras_cosas"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Monto -->" +
          '<div class="col-6 col-md-2 order-md-6 my-1 ' +
          estado +
          ' etiquetaMontoHogar" id = "etiquetaMontoHogar' +
          numHogar +
          '" style="padding-left:0px">' +
          "<label>Monto</label>" +
          "</div>" +
          '<div class="col-6 col-md-2 order-md-13 my-1" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<input type="text" class="form-control validarNumerosLetras montoHogar" id="montoHogar' +
          numHogar +
          '" name="montoHogar' +
          numHogar +
          '" placeholder="MONTO HOGAR" autocomplete="off" style="text-transform: uppercase" value = "' +
          data[i]["monto"] +
          '"></input>' +
          "</div>" +
          "</div>" +
          "<!-- Acciones -->" +
          '<div class="col-6 col-md-1 order-md-7 my-1 ' +
          estado1 +
          ' etiquetaAcciones" id = "etiquetaAcciones' +
          numHogar +
          '" style="padding-left:0px">' +
          "<label></label>" +
          "</div>" +
          '<div class="col-12 col-md-1 order-md-14 my-1" style="padding-left:0px">' +
          '<input type="hidden" class="valor_deducible_hogar" id="valor_deducible_hogar' +
          numHogar +
          '" name="valor_deducible_hogar' +
          numHogar +
          '" value="' +
          valor +
          '">' +
          '<button type="button" class="form-control btn btn-danger quitarHogar idHogar="' +
          numHogar +
          '"><i class="fa fa-times"></i></button>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      $("#tipoHogar" + numHogar)
        .val(data[i]["tipo"])
        .change();
    }
  }
}
