async function listaNotificacionesReembolsosAsistenciaMedica() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_reembolso_asistencia_medica.php"
    );
    $("#menuNotificacionesReembolsosAsistenciaMedica").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesReembolsosAsistenciaMedicaPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_reembolso_asistencia_medica_empresarial.php"
    );
    $("#menuNotificacionesReembolsosAsistenciaMedicaPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
