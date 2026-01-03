async function listaNotificacionesSeguimentoClientesIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_cliente_individual.php"
    );
    $("#menuNotificacionesClientesIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoClientesPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_cliente_pymes.php"
    );
    $("#menuNotificacionesClientesPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
