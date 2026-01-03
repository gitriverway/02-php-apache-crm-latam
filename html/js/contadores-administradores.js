/********************************************
 ***LSITADO DE CONTADORES GENERALES**********
 *******************************************/

// Helper function to make AJAX calls and return Promises
function fetchCount(url) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: url,
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        try {
          const data = JSON.parse(respuesta);
          // Resolve with the parsed data
          resolve(data);
        } catch (e) {
          // Reject if JSON parsing fails
          reject({
            message: "Failed to parse JSON response",
            error: e,
            response: respuesta,
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        // Reject if AJAX call fails
        reject({ jqXHR, textStatus, errorThrown });
      },
    });
  });
}

// Refactored functions to use async/await for better readability
async function contarProspectosWeb() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_prospecto_web.php"
    );
    // If data is valid and contains 'contador', update the element.
    // Otherwise, set to '0' to indicate no records and avoid errors.
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorWeb").text(data[0]["contador"]);
    } else {
      $("#contadorWeb").text("0"); // Set to '0' if no data or unexpected format
    }
  } catch (error) {
    // Handle errors without logging to console as per user feedback
    $("#contadorWeb").text("0");
  }
}

async function contarProspectos() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_prospectos.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorProspecto").text(data[0]["contador"]);
    } else {
      $("#contadorProspecto").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorProspecto").text("0");
  }
}

async function contarProspectosPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_prospectos_empresariales.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorProspectoPymes").text(data[0]["contador"]);
    } else {
      $("#contadorProspectoPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorProspectoPymes").text("0");
  }
}

async function contarContratosAsistenciaMedica() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_asistencia_medica.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoAsistenciaMedica").text(data[0]["contador"]);
    } else {
      $(".contadorContratoAsistenciaMedica").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoAsistenciaMedica").text("0");
  }
}

async function contarContratosAsistenciaMedicaPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_asistencia_medica_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoAsistenciaMedicaPymes").text(data[0]["contador"]);
    } else {
      $(".contadorContratoAsistenciaMedicaPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoAsistenciaMedicaPymes").text("0");
  }
}

async function contarContratosVehiculo() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_vehiculos.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoVehiculos").text(data[0]["contador"]);
    } else {
      $(".contadorContratoVehiculos").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoVehiculos").text("0");
  }
}

async function contarContratosVidaIndividual() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_vida_individual.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoVidaIndividual").text(data[0]["contador"]);
    } else {
      $("#contadorContratoVidaIndividual").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoVidaIndividual").text("0");
  }
}

async function contarContratosVidaPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_vida_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoVidaEmpresarial").text(data[0]["contador"]);
    } else {
      $("#contadorContratoVidaEmpresarial").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoVidaEmpresarial").text("0");
  }
}

async function contarContratosAccidentesPersonalesIndividual() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_accidentes_personales_individual.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoAccidentesPersonales").text(data[0]["contador"]);
    } else {
      $("#contadorContratoAccidentesPersonales").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoAccidentesPersonales").text("0");
  }
}

async function contarContratosAccidentesPersonalesPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_accidentes_personales_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoAccidentesPersonalesPymes").text(data[0]["contador"]);
    } else {
      $("#contadorContratoAccidentesPersonalesPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoAccidentesPersonalesPymes").text("0");
  }
}

async function contarContratosHogarIndividual() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_hogar_individual.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoHogar").text(data[0]["contador"]);
    } else {
      $(".contadorContratoHogar").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoHogar").text("0");
  }
}

async function contarContratosResponsabilidadCivil() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_responsabilidad_civil.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoResponsabilidadCivil").text(data[0]["contador"]);
    } else {
      $("#contadorContratoResponsabilidadCivil").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoResponsabilidadCivil").text("0");
  }
}

async function contarContratosResponsabilidadCivilPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_responsabilidad_civil_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorContratoResponsabilidadCivilPymes").text(data[0]["contador"]);
    } else {
      $("#contadorContratoResponsabilidadCivilPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoResponsabilidadCivilPymes").text("0");
  }
}

async function contarContratosIncendioPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_incendio_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoIncendioPymes").text(data[0]["contador"]);
    } else {
      $(".contadorContratoIncendioPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoIncendioPymes").text("0");
  }
}

async function contarContratosTransportePymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_contratos_transporte_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $(".contadorContratoTransportePymes").text(data[0]["contador"]);
    } else {
      $(".contadorContratoTransportePymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $(".contadorContratoTransportePymes").text("0");
  }
}

async function contarReembolsosAsistenciaMedica() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_reembolsos.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorReembolsos").text(data[0]["contador"]);
    } else {
      $("#contadorReembolsos").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorReembolsos").text("0");
  }
}

async function contarReembolsosAsistenciaMedicaPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_reembolsos_empresariales.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorReembolsosPymes").text(data[0]["contador"]);
    } else {
      $("#contadorReembolsosPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorReembolsosPymes").text("0");
  }
}

async function contarCreditosHospitalariosAsistenciaMedica() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_credito_hospitalario.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorCreditoHospitalario").text(data[0]["contador"]);
    } else {
      $("#contadorCreditoHospitalario").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorCreditoHospitalario").text("0");
  }
}

async function contarCreditosHospitalariosAsistenciaMedicaPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_credito_hospitalario_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorCreditoHospitalarioPymes").text(data[0]["contador"]);
    } else {
      $("#contadorCreditoHospitalarioPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorCreditoHospitalarioPymes").text("0");
  }
}

async function contarCreditosAmbulatoriosAsistenciaMedica() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_credito_ambulatorio.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorCreditoAmbulatorio").text(data[0]["contador"]);
    } else {
      $("#contadorCreditoAmbulatorio").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorCreditoAmbulatorio").text("0");
  }
}

async function contarCreditosAmbulatoriosAsistenciaMedicaPymes() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_credito_ambulatorio_empresarial.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorCreditoAmbulatorioPymes").text(data[0]["contador"]);
    } else {
      $("#contadorCreditoAmbulatorioPymes").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorContratoAmbulatorioPymes").text("0");
  }
}

async function contarSiniestroVehiculoIndividual() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_siniestros_vehiculos_individual.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorSiniestros").text(data[0]["contador"]);
    } else {
      $("#contadorSiniestros").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorSiniestros").text("0");
  }
}

async function contarSiniestroHogarIndividual() {
  try {
    const data = await fetchCount(
      "controller/contadores/controlador_contador_siniestros_hogares_individual.php"
    );
    if (
      data &&
      Array.isArray(data) &&
      data.length > 0 &&
      data[0].hasOwnProperty("contador")
    ) {
      $("#contadorSiniestrosHogar").text(data[0]["contador"]);
    } else {
      $("#contadorSiniestrosHogar").text("0");
    }
  } catch (error) {
    // Handle errors without logging to console
    $("#contadorSiniestrosHogar").text("0");
  }
}

// Orchestration functions to run all fetches in parallel using async/await
async function contadoresGenerales() {
  try {
    await Promise.all([
      contarProspectosWeb(),
      contarProspectos(),
      contarProspectosPymes(),
    ]);
  } catch (error) {
    // This catch block handles errors from Promise.all itself,
    // but individual function catches handle specific AJAX errors.
    // No console logging as per user feedback.
  }
}

async function contadoresGeneralesServicios() {
  try {
    await Promise.all([
      contarContratosAsistenciaMedica(),
      contarContratosVehiculo(),
      contarContratosVidaIndividual(),
      contarContratosAccidentesPersonalesIndividual(),
      contarContratosHogarIndividual(),
      contarContratosVidaPymes(),
      contarContratosAsistenciaMedicaPymes(),
      contarContratosAccidentesPersonalesPymes(),
      contarContratosResponsabilidadCivil(),
      contarContratosResponsabilidadCivilPymes(),
      contarContratosIncendioPymes(),
      contarContratosTransportePymes(),
      contarReembolsosAsistenciaMedica(),
      contarReembolsosAsistenciaMedicaPymes(),
      contarCreditosHospitalariosAsistenciaMedica(),
      contarCreditosHospitalariosAsistenciaMedicaPymes(),
      contarCreditosAmbulatoriosAsistenciaMedica(),
      contarCreditosAmbulatoriosAsistenciaMedicaPymes(),
      contarSiniestroVehiculoIndividual(),
      contarSiniestroHogarIndividual(),
    ]);
  } catch (error) {
    // This catch block handles errors from Promise.all itself,
    // but individual function catches handle specific AJAX errors.
    // No console logging as per user feedback.
  }
}
