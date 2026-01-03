async function listaNotificacionesSeguimentoRenovacionesAsistenciaMedica() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_asistencia_medica.php"
    );
    $("#menuNotificacionesRenovasionesAsistenciaMedica").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesAsistenciaMedicaPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_asistencia_medica_empresarial.php"
    );
    $("#menuNotificacionesRenovasionesAsistenciaMedicaPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
