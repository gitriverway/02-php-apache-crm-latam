/*********************************
EDITAR BAYER PERSONA
*********************************/
// Mapping for prospect editing
const prospectEditRoutes = {
  individual: { route: "editar-prospecto", param: "idProspecto" },
  empresarial: { route: "editar-prospecto-empresarial", param: "idProspecto" },
};

// Helper function for prospect redirection
function redirectToProspectEdit(type, idProspecto) {
  const config = prospectEditRoutes[type];
  if (config) {
    window.location = `index.php?ruta=${config.route}&${config.param}=${idProspecto}`;
  } else {
    console.warn(`No route defined for prospect type: ${type}`);
  }
}

$("#menuNotificacionesProspectosIndividual").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("individual", idCliente);
  }
);

$("#menuNotificacionesProspectosAltoIndividual").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("individual", idCliente);
  }
);

$("#menuNotificacionesProspectosMedioIndividual").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("individual", idCliente);
  }
);

$("#menuNotificacionesProspectosBajoIndividual").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("individual", idCliente);
  }
);

$("#menuNotificacionesProspectosPymes").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("empresarial", idCliente);
  }
);
$("#menuNotificacionesProspectosAltoPymes").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("empresarial", idCliente);
  }
);

$("#menuNotificacionesProspectosMedioPymes").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("empresarial", idCliente);
  }
);

$("#menuNotificacionesProspectosBajoPymes").on(
  "click",
  ".notificacionEditarBayerPersona",
  function () {
    var idCliente = $(this).attr("idCliente"); // Note: attribute name is idCliente, but it's used as idProspecto in the URL
    // var idCategoria = $(this).attr("idCategoria"); // Not used for prospects
    redirectToProspectEdit("empresarial", idCliente);
  }
);

/*********************************
EDITAR CLIENTE PERSONA
*********************************/
// Mapping for client editing based on idCategoria
const clientEditRoutes = {
  1: { route: "editar-cliente-vida-individual", param: "idCliente" },
  2: {
    route: "editar-cliente-vida-individual-empresarial",
    param: "idCliente",
  },
  3: {
    route: "editar-cliente-asistencia-medica-individual",
    param: "idCliente",
  },
  4: { route: "editar-cliente-vehiculo-individual", param: "idCliente" },
  5: {
    route: "editar-cliente-asistencia-medica-individual-empresarial",
    param: "idCliente",
  },
  7: {
    route: "editar-cliente-accidentes-personales-individual",
    param: "idCliente",
  },
  8: {
    route: "editar-cliente-accidentes-personales-individual-empresarial",
    param: "idCliente",
  },
  9: { route: "editar-cliente-hogar-individual", param: "idCliente" },
  11: {
    route: "editar-cliente-responsabilidad-civil-individual",
    param: "idCliente",
  },
  12: {
    route: "editar-cliente-responsabilidad-civil-empresarial",
    param: "idCliente",
  },
  13: { route: "editar-cliente-vehiculo-empresarial", param: "idCliente" }, // Corrected from duplicate assignment in original code
  15: { route: "editar-cliente-incendio-empresarial", param: "idCliente" },
  16: { route: "editar-cliente-transporte-empresarial", param: "idCliente" },
};

// Helper function for client redirection
function redirectToClientEdit(idCategoria, idCliente) {
  const config = clientEditRoutes[idCategoria];
  if (config) {
    window.location = `index.php?ruta=${config.route}&${config.param}=${idCliente}`;
  } else {
    console.warn(`No route defined for client category: ${idCategoria}`);
  }
}

$("#menuNotificacionesClientesIndividual").on(
  "click",
  ".notificacionEditarCliente",
  function () {
    var idCliente = $(this).attr("idCliente");
    var idCategoria = $(this).attr("idCategoria");
    // console.log(idCategoria); // Removed for cleaner code, can be added back if needed for debugging
    redirectToClientEdit(idCategoria, idCliente);
  }
);

$("#menuNotificacionesClientesPymes").on(
  "click",
  ".notificacionEditarCliente",
  function () {
    var idCliente = $(this).attr("idCliente");
    var idCategoria = $(this).attr("idCategoria");
    console.log(idCategoria); // Keeping this console.log as it was in the original code
    redirectToClientEdit(idCategoria, idCliente);
  }
);

/*********************************
EDITAR CLIENTE RENOVACIÓN
*********************************/
$(".menuNotificacionesRenovasiones").on(
  "click",
  ".notificacionEditarCliente",
  function () {
    var idCliente = $(this).attr("idCliente");
    var idCategoria = $(this).attr("idCategoria");
    console.log(idCategoria); // Keeping this console.log as it was in the original code
    redirectToClientEdit(idCategoria, idCliente);
  }
);
