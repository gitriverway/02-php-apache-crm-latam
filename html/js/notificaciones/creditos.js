async function listaNotificacionesCreditosHospitalariosAsistenciaMedica() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_credito_hospitalario_asistencia_medica.php"
    );
    $("#menuNotificacionesCreditosHospitalariosAsistenciaMedica").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesCreditosHospitalariosAsistenciaMedicaPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_credito_hospitalario_asistencia_medica_empresarial.php"
    );
    $("#menuNotificacionesCreditosHospitalariosAsistenciaMedicaPymes").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesCreditosAmbulatoriosAsistenciaMedica() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_credito_ambulatorio_asistencia_medica.php"
    );
    $("#menuNotificacionesCreditosAmbulatoriosAsistenciaMedica").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesCreditosAmbulatoriosAsistenciaMedicaPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_credito_ambulatorio_asistencia_medica_empresarial.php"
    );
    $("#menuNotificacionesCreditosAmbulatoriosAsistenciaMedicaPymes").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}
