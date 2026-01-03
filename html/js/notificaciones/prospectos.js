async function listaNotificacionesSeguimientosProspectosIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_individual.php"
    );
    $("#menuNotificacionesProspectosIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors without logging to console
  }
}
async function listaNotificacionesSeguimientosProspectosAltoIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_alto_individual.php"
    );
    $("#menuNotificacionesProspectosAltoIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors without logging to console
  }
}
async function listaNotificacionesSeguimientosProspectosMedioIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_medio_individual.php"
    );
    $("#menuNotificacionesProspectosMedioIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors without logging to console
  }
}
async function listaNotificacionesSeguimientosProspectosBajoIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_bajo_individual.php"
    );
    $("#menuNotificacionesProspectosBajoIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors without logging to console
  }
}

async function listaNotificacionesSeguimientosProspectosPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_pymes.php"
    );
    $("#menuNotificacionesProspectosPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimientosProspectosAltoPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_alto_pymes.php"
    );
    $("#menuNotificacionesProspectosAltoPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
async function listaNotificacionesSeguimientosProspectosMedioPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_medio_pymes.php"
    );
    $("#menuNotificacionesProspectosMedioPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
async function listaNotificacionesSeguimientosProspectosBajoPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_prospecto_bajo_pymes.php"
    );
    $("#menuNotificacionesProspectosBajoPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
