/********************************************
 ***LSITADO DE CONTADORES CLIENTES**********
 *******************************************/

function contarContratosClienteAsistenciaMedica() {
  $.ajax({
    url: "controller/contadores/controlador_contador_contratos_cliente_asistencia_medica.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      $("#contadorContratosClienteAsistenciaMedica").text(data[0]["contador"]);
    },
  });
}

function contarContratosClienteVehiculo() {
  $.ajax({
    url: "controller/contadores/controlador_contador_contratos_cliente_vehiculo.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      $("#contadorContratosClienteVehiculo").text(data[0]["contador"]);
    },
  });
}

function contarReembolsosCliente() {
  $.ajax({
    url: "controller/contadores/controlador_contador_reembolsos_cliente.php",
    method: "POST",
    cache: false,
    contentType: false,
    processData: false,
    success: function (respuesta) {
      var data = JSON.parse(respuesta);

      $("#contadorReembolsosClientes").text(data[0]["contador"]);
    },
  });
}

function contadoresClientes() {
  contarContratosClienteAsistenciaMedica();
  contarContratosClienteVehiculo();
  contarReembolsosCliente();
}
