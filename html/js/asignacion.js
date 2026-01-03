/*********************************
 CARGAR LISTA DE CLIENTES ASIGNADOS EN TABLA
 *********************************/
// function lista1() {
//   $.ajax({
//     url: "controller/prospectos_web/controlador_prospecto_listar.php",
//     method: "POST",
//     cache: false,
//     contentType: false,
//     processData: false,
//     success: function (respuesta) {
//       console.log(respuesta);
//     },
//   });
// }

if (window.matchMedia("(max-width:767px)").matches) {
  $("#tabla_asignacion").removeClass("nowrap");
  $("#tabla_asignacion").addClass("dt-responsive");
} else {
  $("#tabla_asignacion").removeClass("dt-responsive");
  $("#tabla_asignacion").addClass("nowrap");
}

var table;

function listar_asignacion() {
  table = $("#tabla_asignacion").DataTable({
    scrollX: true,
    ordering: false,
    destroy: true,
    processing: true,
    pageLength: 5,
    //     // "dom": "Plfrtip",
    dom: "PBfrtip", // 'P' para SearchPanes
    select: true, // Activa Select
    ajax: "controller/prospectos_web/controlador_prospecto_listar.php",
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
        targets: [1, 2, 5, 6, 7, 8, 9, 11, 13, 16, 17],
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

$("#tabla_asignacion").on(
  "searchPanes.select searchPanes.deselect",
  function () {
    setTimeout(function () {
      $(".dtsp-paneTable tr.dtsp-selected").each(function () {
        $(this).css({
          "background-color": "#007bff",
          color: "white",
          "font-weight": "bold",
        });
      });
    }, 100);
  }
);

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

/*********************************
 ABRIR MODAL ASIGNAR VENDEDOR
 *********************************/
// $("#tabla_asignacion").on("click", ".btnListaVendedor", function () {
//   // $("#modal_asignar_vendedor").modal({ backdrop: "static", keyboard: false });
//   // $("#modal_asignar_vendedor").modal("show");
//   alert("hola");
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
      table.ajax.reload();
      $("#modal_asignar_vendedor").modal("hide");
    });
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
    url: "controller/prospectos_web/controlador_modificar_vendedor_asignado_a_prospecto.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {},
  });
}
/*********************************
 ELIMINAR PROSPECTO
 *********************************/
$("#tabla_asignacion").on("click", ".btnEliminarProspectoWeb", function () {
  var idProspecto = $(this).attr("idProspecto");

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
      eliminar_prospecto_web(idProspecto);
    }
  });
});

function eliminar_prospecto_web(idProspecto) {
  var datos = new FormData();
  datos.append("idProspecto", idProspecto);

  $.ajax({
    url: "controller/prospectos_web/controlador_prospecto_eliminar.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      if (respuesta == 1) {
        Swal.fire("Eliminado!", "El Prospecto ha sido eliminado.", "success");
        table.ajax.reload();
      } else {
        Swal.fire("Oops...!", "El Prospecto no pudo ser eliminado.", "error");
      }
      return respuesta;
    },
  });
}

/*********************************
 ABRIR MODAL CHAT
 *********************************/
var numObservacion = 0;
$("#tabla_asignacion").on("click", ".btnChatWeb", function () {
  $("#modalChatWeb").modal({ backdrop: "static", keyboard: false });
  $("#modalChatWeb").modal("show");

  numObservacion = 0;

  $("#todoChats").empty();

  var idProspecto = $(this).attr("idProspecto");

  var datos = new FormData();

  datos.append("idProspecto", idProspecto);

  $.ajax({
    url: "controller/prospectos_web/controlador_prospecto_web_chat.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      if (data.length > 0) {
        $("#listaChats").val(data[0]["prospecto_web_chat"]);

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

var listarCheckAsignar = [];
var listarCheckAsignarTodos = 0;

$("#tabla_asignacion").on("click", ".chkSeleccionarAsignar", function () {
  var idProspecto = $(this).attr("idProspecto");
  // console.log(idProspecto);

  if ($(this).is(":checked")) {
    listarCheckAsignar.push(idProspecto);
  } else {
    listarCheckAsignar = listarCheckAsignar.filter(
      (lista) => lista != idProspecto
    );
  }

  // console.log(listarCheckAsignar);
});

$("#tabla_asignacion").on("click", ".chkSeleccionarTodoAsignar", function () {
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
